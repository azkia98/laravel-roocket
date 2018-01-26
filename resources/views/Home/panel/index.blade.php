@component('Home.panel.master')

<ul style="margin: 20px">
    <li><span>نام کاربری :</span><span>{{ auth()->user()->name }}</span></li>
    <li><span>ایمیل کاربری :</span><span>{{ auth()->user()->email}}</span></li>
    
    
    {{--@if(auth()->user->isActive())
    <li>زمان پایان پروژه</li>
    @else
    <li>
        شما عوض ویژه نیستید
    </li>
    @endif--}}
</ul>

@endcomponent