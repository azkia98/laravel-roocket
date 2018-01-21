<?php

namespace App\Providers;

use App\Comment;
use App\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('recaptcha' , function ($attribute , $value , $parameters , $validator){
            // POST
            $client = new Client();
            $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $value,
                    'remoteip' => request()->ip()
                ]
            ]);

            $response = json_decode($response->getBody());

            return $response->success;
//            return
        });
        view()->composer('Admin.section.header' , function($view) {
            $commentUnsuccessfulCount = Comment::whereApproved(0)->count();
            $commentSuccessCount = Comment::whereApproved(1)->count();

            $paymentUnsuccessfulCount = Payment::wherePayment(0)->count();
            $paymentSuccessCount = Payment::wherePayment(1)->count();
            $view->with([
                'commentUnsuccessfulCount' => $commentUnsuccessfulCount,
                'commentSuccessfulCount' => $commentSuccessCount,
                'paymentSuccessCount' => $paymentSuccessCount,
                'paymentUnsuccessfulCount' => $paymentUnsuccessfulCount,
                ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
