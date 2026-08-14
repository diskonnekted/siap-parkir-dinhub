<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SIAP | Login Admin</title>
<meta content="Sistem Informasi Aplikasi Parkir" name="description">
<meta content="siap, parkir, dinas perhubungan, dinhub, banjarnegara" name="keywords">
<meta content="exadata, fariezjm" name="authors">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ asset('images/favicon.png') }}" rel="icon">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('template/css/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/css/et-line-font/et-line-font.css') }}">
<link rel="stylesheet" href="{{ asset('template/css/themify-icons/themify-icons.css') }}">

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="login-page">
<div class="login-box">
  <div class="login-box-body">
    <h3 class="login-box-msg">Login Administrator</h3>
    <form action="{{ $action }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="name" name="username" class="form-control sty1" placeholder="Username" required>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control sty1" placeholder="Password" required>
      </div>
      <div>
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
          @if(session('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('message') }}
            </div>
          @endif
        </div>
        <!-- /.col -->
        <div class="col-xs-4 m-t-1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ $button }}</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
  </div>
</div>

<!-- jQuery 3 --> 
<script src="{{ asset('template/js/jquery.min.js') }}"></script> 
<!-- v4.0.0-alpha.6 --> 
<script src="{{ asset('assets/js/tether.min.js') }}"></script>
<script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script> 
<!-- template --> 
<script src="{{ asset('template/js/niche.js') }}"></script>
</body>
</html>
