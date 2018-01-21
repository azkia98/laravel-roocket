@extends('Home.master')

@section('content')

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1>به راکت خوش آمدید</h1>
        <p>معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می‌رسد و قلم‌ها و اندازه‌بندی‌ها چگونه در نظر گرفته شده‌است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می‌باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه‌آرایی می‌کنند تا مرحله طراحی و صفحه‌بندی را به پایان برند.</p>
        </p>
    </header>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <h3>آخرین دوره ها</h3>
        </div>
    </div>
    <div class="row ">

        @foreach($courses as $course)
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{{ $course->images['thumb'] }}" alt="">
                    <div class="caption">
                        <h3><a href="{{ $course->path() }}">{{ $course->title }}</a></h3>
                        <p>{{ str_limit($course->description , 120) }}</p>
                        <p>
                            <a href="{{ $course->path()  }}" class="btn btn-primary">خرید</a> <a href="{{ $course->path()  }}" class="btn btn-default">اطلاعات بیشتر</a>
                        </p>
                    </div>
                    <div class="ratings">
                        <p class="pull-left">{{ $course->viewCount }} بازدید</p>
                        {{--<p class="pull-left">{{  Redis::get("views.{$course->id}.courses") }} بازدید</p>--}}
                    </div>
                </div>
            </div>
        @endforeach


    </div>
    <hr>

    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-12">
                <h3>مقالات</h3>
            </div>
            @foreach($articles as $article)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ $article->images['thumb'] }}" alt="">
                        <div class="caption">
                            <h4><a href="{{ $article->path() }}">{{ $article->title }}</a>
                            </h4>
                            <p>{{ str_limit($article->description , 120) }}</p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">{{ $article->viewCount }} بازدید</p>
{{--                            <p class="pull-right">{{ Redis::get("views.{$article->id}.articles") }} بازدید</p>--}}

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection