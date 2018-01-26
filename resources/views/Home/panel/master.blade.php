@extends('Home.master')

@section('content')
<div class="jumbotron">
  <h1>پنل کاربری</h1>
  <p>شما میتوانید اطلاعات خودتان را ویرانش کنید</p>
</div>


<ul class="nav nav-tabs">
  <li role="presentation" class="{{ Route::currentRouteName() == 'user.panel' ? 'active':''}}"><a href="{{ route('user.panel')}}">اطلاعات کاربری</a></li>
  <li role="presentation" class="{{ Route::currentRouteName() == 'user.panel.history' ? 'active':''}}"><a href="{{ route('user.panel.history')}}">پرداخت های انجام شده</a></li>
  <li role="presentation" class="{{ Route::currentRouteName() == 'user.panel.vip' ? 'active':''}}"><a href="{{ route('user.panel.vip')}}">شارژ vip</a></li>
</ul>


    {{$slot}}

@endsection