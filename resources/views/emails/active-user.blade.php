@component('mail::message')
#ایمیل فعالسازی

@component('mail::button' , ['url' => route('activation.account' , $code)])
    فعال سازی اکانت
@endcomponent

@endcomponent


