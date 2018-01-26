@component('Home.panel.master')

<div>
    <form action="{{ route('user.panel.vip.payment')}}" method="post">
        {{csrf_field()}}
        <select>
            <option value="1">عضوریت ویژه ۱ ماه ۱۰۰۰ تومان</option>
            <option value="3">عضوریت ویژه 3 ماه 3۰۰۰ تومان</option>
            <option value="12">عضوریت ویژه 12 ماه 12۰۰۰ تومان</option>
        </select>
        <button type="submit">ثبت نام</button>
    </form>
</div>

@endcomponent