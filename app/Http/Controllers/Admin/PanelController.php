<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Permission;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index()
    {
        $month = 12;
        $paymentSuccess = Payment::spanningPayment($month , true);
        $paymentUnSuccess = Payment::spanningPayment($month , false);

        $labels = $this->getLastMonths($month);

        $values['success'] = $this->CheckCount($paymentSuccess->pluck('published') , $month);
        $values['unsuccess'] = $this->CheckCount($paymentUnSuccess->pluck('published') , $month);

        return view('Admin.panel' , compact('labels' , 'values'));
    }

    public function uploadImageSubject()
    {
        $this->validate(request() , [
            'upload' => 'required|mimes:jpeg,png,bmp',
        ]);

        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";

        $file = request()->file('upload');
        $filename = $file->getClientOriginalName();

        if(file_exists(public_path($imagePath) . $filename)) {
            $filename = Carbon::now()->timestamp . $filename;
        }

        $file->move(public_path($imagePath) , $filename);
        $url = $imagePath . $filename;

        return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$url}' , '')</script>";
    }

    private function getLastMonths($month)
    {
        for ($i = 0 ; $i < $month ; $i++) {
            $labels[] = jdate( Carbon::now()->subMonths($i))->format('%B');
        }
        return array_reverse($labels);
    }

    private function CheckCount($count, $month)
    {
        for ($i = 0 ; $i < $month ; $i++) {
            $new[$i] = empty($count[$i]) ? 0 : $count[$i];
        }
        return array_reverse($new);
    }
}
