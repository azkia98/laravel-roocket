<?php

namespace App\Http\Controllers;

use App\Course;
use App\Learning;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use SoapClient;

class CourseController extends Controller
{
    protected $MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be'; //Required


    public function single(Course $course)
    {
        $course->increment('viewCount');

//        Redis::incr("views.{$course->id}.courses");
        $comments = $course->comments()->where('approved' , 1)->where('parent_id', 0)->latest()->with('comments')->get();
        return view('Home.courses' , compact('course' , 'comments'));
    }

    public function payment()
    {
        $this->validate(request() , [
            'course_id' => 'required'
        ]);

        $course = Course::findOrFail(request('course_id'));

        if(auth()->user()->checkLearning($course)) {
            alert()->error('شما قبلا در این دوره ثبت نام کرده اید','دقت کنید')->persistent('خیلی خوب');
            return back();
        }

        if($course->price == 0 && $course->type == 'vip') {
            alert()->error('این دوره قابل خریداری توسط شما نیست','دقت کنید')->persistent('خیلی خوب');
            return back();
        }

        $price = $course->price;

        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = auth()->user()->email; // Optional
        $CallbackURL = 'http://localhost:8000/course/payment/checker'; // Required

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $price,
                'Description' => $Description,
                'Email' => $Email,
                'CallbackURL' => $CallbackURL,
            ]
        );

        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {

            auth()->user()->payments()->create([
                'resnumber' => $result->Authority,
                'price' => $price,
                'course_id' => $course->id
            ]);

            return redirect('https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
        } else {
            echo 'ERR: ' . $result->Status;
        }
    }


    public function checker()
    {
        $Authority = request('Authority');

        $payment = Payment::whereResnumber($Authority)->firstOrFail();
        $course = Course::findOrFail($payment->course_id);


        if (request('Status') == 'OK') {
            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $payment->price,
                ]
            );

            if ($result->Status == 100) {
                if($this->AddUserForLearning($payment, $course)) {
                    alert()->success('عملیات مورد نظر با موفقیت انجام شد','با تشکر');
                    return redirect($course->path());
                }
            } else {
                echo 'Transaction failed. Status:'.$result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }

    }

    protected function AddUserForLearning($payment , $course)
    {
        $payment->update([
            'payment' => 1
        ]);

        Learning::create([
            'user_id' => auth()->user()->id,
            'course_id' => $course->id
        ]);

        return true;
    }
}
