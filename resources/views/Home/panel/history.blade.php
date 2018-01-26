@component('Home.panel.master')

<div>
<table class="table"> 
    <thead> 
        <tr> 
            <th>مقدار پرداخت</th> 
            <th>وضعیت پرداخت</th>
        </tr> 
    </thead> 
    <tbody>
        @foreach($payments as $payment)
        <tr> 
            <th scope="row">{{ $payment->price }} تومان</th> 
            <td>{{$payment->payment == 1 ? 'موفع':'نا موفق'}}</td> 
        </tr> 
        @endforeach
    </tbody> 
</table>
</div>

@endcomponent