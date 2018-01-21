@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>همه نظرات</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام کاربر</th>
                    <th>مقدار پرداختی</th>
                    <th>نوع پرداخت</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->price }}</td>
                        @if($payment->course_id == 'vip')
                            <td>بابت عضویت ویژه</td>
                        @else
                            <td>{{ $payment->course->title }}</td>
                        @endif
                        <td>
                            <div style="display: flex">
                                <form action="{{ route('payments.destroy'  , ['id' => $payment->id]) }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-xs btn-danger">حذف</button>
                                </form>
                                <form style="margin-right: 5px" action="{{ route('payments.update'  , ['id' => $payment->id]) }}" method="post">
                                    {{ method_field('patch') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-xs btn-success">تایید</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align: center">
            {!! $payments->render() !!}
        </div>
    </div>
@endsection