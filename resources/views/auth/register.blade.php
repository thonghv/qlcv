@extends('layouts.app')
@section('title', "Bệnh viện đa khoa")
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Đăng ký cho người dùng mới</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Họ và Tên</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Địa chỉ email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Xác nhận lại mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userimage" class="col-md-4 control-label">Hình đại diện</label>

                            <div class="col-md-6">
                                <input id="userimage" type="file" class="form-control" name="userimage" required>
                                @if ($errors->has('userimage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userimage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="permission"  class="col-md-4 control-label">Phân quyền</label>
                            <div class="col-md-6">
                                <select id='permission' name="permission" class="input-large form-control">
                                    <option value="USER" selected="selected">Người dùng</option>
                                    <option value="MANAGER">Cấp quản lý</option>
                                    <option value="ADMIN">Quản trị hệ thống (Admin)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department"  class="col-md-4 control-label">Phòng ban</label>
                            <div class="col-md-6">
                            @if($todos != false)
                                <select multiple="multiple" id='departments' name="departments[]" class="select2-multiple input-large form-control">
                                @foreach ($todos as $todo)
                                    <option value="{{$todo->id}}">{{$todo->todo}}</option>
                                @endforeach
                                </select>
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department"  class="col-md-4 control-label">Có quyền thêm người dùng khác vào phòng ban</label>
                            <div class="col-md-6">
                                <input name="add_user" type="checkbox" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: "Select",
                allowClear: true
            });

        });

    </script>
</div>
@endsection
