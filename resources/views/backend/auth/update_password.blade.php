<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản lý tài liệu</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/default.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Cập nhật mật khẩu</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @if (Session::has('danger') && ($message = Session::get('danger')))
            <div class="alert alert-danger alert-dismissible">
                <p><i class="icon fa fa-ban"></i>{!! $message !!}</p>
            </div>
        @endif
        @if (Session::has('success') && ($message = Session::get('success')))
            <div class="alert alert-success alert-dismissible">
                <p><i class="icon fa fa-ban"></i>{!! $message !!}</p>
            </div>
        @endif
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" value="">
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="rpassword" value="">
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('rpassword') }}</p></span>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <a href="{{route('login')}}">Quay lại đăng nhập</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-5">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"> <i class="fa fa-fw fa-sign-in"></i>Cập nhật </button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="{{ asset('admin/theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin/theme/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
