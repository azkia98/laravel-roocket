@extends('Home.master')


@section('content')
    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        <!-- Blog Post -->

        <!-- Title -->
        <h1>عنوان  دوره</h1>

        <!-- Author -->
        <p class="lead small">
            توسط <a href="#">حسام موسوی</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> ارسال شده در ۱۲ خرداد ۹۶</p>

        <hr>

        <!-- Post Content -->
        <p dir="rtl">دیمونس در واقع فرایند های پشت زمینه سیستم شما رو در بر می گیره. که معمولا یا در هنگام بوت شدن سیستم شروع به کار میکنه و یا بعد از اینکه به دسکتاپ وارد شدید.</p>

        <p dir="rtl"><strong>Shell</strong></p>

        <p dir="rtl">&nbsp;به احتمال زیاد چیزی به اسم خط فرمان لینوکس رو شنیده باشید. این قسمت رو شل یا پوسته میگن. در واقع جایی هستش که شما می تونید از طریق متن در یک محیط متنی با کامپیوتر ارتباط برقرار کنید. اینجا جاییه که باعث میشه مردم بیشترین ترس رو نسبت به لینوکس پیدا کنند. البته با حضور دسکتاپ های گرافیکی مدرن کمتر برای انجام کارهای روزمره به محیط کامند لاین احتیاج پیدا می کنیم.&nbsp;</p>

        <p dir="rtl"><strong>Graphical Server</strong></p>

        <p dir="rtl">&nbsp;در واقع این قسمت رو میشه یک زیر سیستم به حساب آورد که می تونه گرافیک رو روی صفحه نمایش، نشون بده. اغلب اوقات ما اون رو با اسم X-Server هم می بینیم.</p>
        <hr>
        <div class="alert alert-danger" role="alert">برای مشاهده تمامی قسمت ها باید این دوره را خریداری کنید</div>
        <div class="alert alert-danger" role="alert">برای مشاهده تمامی قسمت ها باید عضویت ویژه تهیه کنید</div>

        <h3>قسمت های دوره</h3>
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>شماره قسمت</th>
                    <th>عنوان قسمت</th>
                    <th>زمان قسمت</th>
                    <th>دانلود</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>قسمت اول</td>
                    <td>۱۰:۲۰</td>
                    <td>
                        <a href="#"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>قسمت اول</td>
                    <td>۱۰:۲۰</td>
                    <td>
                        <a href="#"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>قسمت اول</td>
                    <td>۱۰:۲۰</td>
                    <td>
                        <a href="#"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                    </td>
                </tr><tr>
                    <th scope="row">1</th>
                    <td>قسمت اول</td>
                    <td>۱۰:۲۰</td>
                    <td>
                        <a href="#"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                    </td>
                </tr><tr>
                    <th scope="row">1</th>
                    <td>قسمت اول</td>
                    <td>۱۰:۲۰</td>
                    <td>
                        <a href="#"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                    </td>
                </tr>


            </tbody> </table>
        <!-- Blog Comments -->

        @include('Home.layouts.comment' , ['comments' => $comments , 'subject' => $course])
    </div>

    <!-- Blog Sidebar Widgets Column -->

        <div class="col-md-4">
            @if(! auth()->user()->checkLearning($course))
                 <div class="well">
            برای استفاده از این دوره نیاز است این دوره را با مبلغ ۱۰۰۰۰ تومان خریداری کنید
            <form action="/course/payment" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <button type="submit" class="btn btn-success">خرید دوره</button>
            </form>
        </div>
            @endif
        <!-- Blog Search Well -->
        <div class="well">
            <h4>جستجو در سایت</h4>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
            <!-- /.input-group -->
        </div>

        <!-- Side Widget Well -->
        <div class="well">
            <h4>دیوار</h4>
            <p>طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد.</p>
        </div>

    </div>

@endsection