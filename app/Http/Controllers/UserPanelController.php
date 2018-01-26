<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payment;
use SEO;

class UserPanelController extends Controller
{
    public function index()
    {
        SEO::setTitle('پنل کاربری کاربران');
        return view('Home.panel.index');
    }
    
    public function history()
    {
        SEO::setTitle('تاریخچه پرداخت ها');
        $payments= auth()->user()->payments()->latest()->paginate(20);
        return view('Home.panel.history', compact('payments'));
    }
    
    public function vip()
    {
        return view('Home.panel.vip');
    }
}
