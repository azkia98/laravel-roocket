@extends('Admin.master')

@section('script')
    <script>
        $(document).ready(function () {
            $('#user_id').selectpicker();
            $('#role_id').selectpicker();
        })
    </script>
@endsection


@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>ثبت مقام</h2>
        </div>
        <form class="form-horizontal" action="{{ route('level.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('Admin.section.errors')
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="user_id" class="control-label">کاربران</label>
                    <select class="form-control" name="user_id" id="user_id" data-live-search="true">
                        @foreach(\App\User::whereLevel('admin')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="role_id" class="control-label">مقام ها</label>
                    <select class="form-control" name="role_id" id="role_id">
                        @foreach(\App\Role::all() as $role)
                            <option value="{{ $role->id }}">{{ $role->name }} - {{ $role->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-danger">ارسال</button>
                </div>
            </div>
        </form>
    </div>
@endsection