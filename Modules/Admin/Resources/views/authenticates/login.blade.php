<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Kamibijak</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url('assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('assets/admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('assets/admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('assets/admin/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('assets/admin/plugins/iCheck/square/blue.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-logo">
        <img class="logo-desktop-home" src="{{ default_logo_kamibijak() }}" title="logo-kamibijak" alt=logo-kamibijak"  style="width: 185px;height: auto;margin-bottom: 0rem;margin-top: 7rem;" />
      </div>
    <div class="login-box">    
        <div class="login-box-body">
            <p class="login-box-msg">Sign in as admin</p>
            <form action="" method="post">
            @include('admin::pages_message.notify-msg-error')
            @include('admin::pages_message.form-submit')
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="admin_login_name" autofocus="true">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="admin_login_password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-8">
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
        </div>
    </div>
</body>

<!-- jQuery 3 -->
<script src="{{url('assets/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"')}}></script>
<!-- iCheck -->
<script src="{{url('assets/admin/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

</html>