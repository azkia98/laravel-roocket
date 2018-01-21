@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>ویدیوها ها</h2>
            <a href="{{ route('episodes.create') }}" class="btn btn-sm btn-primary">ارسال ویدیو</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>عنوان ویدیو</th>
                    <th>تعداد نظرات</th>
                    <th>مقدار بازدید</th>
                    <th>تعداد دانلود</th>
                    <th>وضعیت ویدیو</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($episodes as $episode)
                    <tr>
                        <td><a href="{{ $episode->path() }}">{{ $episode->title }}</a></td>
                        <td>{{ $episode->commentCount }}</td>
                        <td>{{ $episode->viewCount }}</td>
                        <td>{{ $episode->downloadCount }}</td>
                        <td>
                            @if($episode->type == 'free')
                                رایگان
                            @elseif($episode->type == 'vip')
                                ویژه
                            @else
                                نقدی
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('episodes.destroy'  , ['id' => $episode->id]) }}" method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="btn-group btn-group-xs">
                                    <a href="{{ route('episodes.edit' , ['id' => $episode->id]) }}"  class="btn btn-primary">ویرایش</a>
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align: center">
            {!! $episodes->render() !!}
        </div>
    </div>
@endsection