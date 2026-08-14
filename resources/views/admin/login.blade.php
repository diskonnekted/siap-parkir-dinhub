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

<!-- Bootstrap v4 -->
<link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ asset('images/favicon.png') }}" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('template/css/font-awesome/css/font-awesome.min.css') }}">

<style>
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: radial-gradient(circle at top left, #1e293b, #0f172a);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 20px;
    overflow-x: hidden;
  }

  /* Background decorative shapes */
  .bg-shape-1 {
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(14, 165, 233, 0.15) 0%, transparent 70%);
    top: -100px;
    left: -100px;
    z-index: 0;
    pointer-events: none;
  }
  .bg-shape-2 {
    position: absolute;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
    bottom: -150px;
    right: -150px;
    z-index: 0;
    pointer-events: none;
  }

  .login-container {
    background: rgba(30, 41, 59, 0.45);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 24px;
    width: 100%;
    max-width: 440px;
    padding: 40px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    position: relative;
    z-index: 10;
    animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .brand-header {
    text-align: center;
    margin-bottom: 35px;
  }

  .brand-logo-container {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 20px rgba(14, 165, 233, 0.25);
    margin-bottom: 20px;
  }

  .brand-logo-container i {
    font-size: 28px;
    color: #fff;
  }

  .brand-header h4 {
    font-weight: 800;
    color: #fff;
    margin: 0;
    letter-spacing: -0.5px;
    font-size: 22px;
  }

  .brand-header p {
    color: #94a3b8;
    font-size: 13px;
    margin-top: 6px;
    font-weight: 500;
  }

  .form-group {
    position: relative;
    margin-bottom: 24px;
  }

  .form-group label {
    font-size: 12px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: block;
  }

  .input-wrapper {
    position: relative;
  }

  .input-wrapper i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 16px;
    transition: color 0.3s;
  }

  .form-control-custom {
    width: 100%;
    background: rgba(15, 23, 42, 0.6) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 14px;
    padding: 14px 16px 14px 48px;
    color: #fff !important;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    outline: none;
    box-shadow: none !important;
  }

  .form-control-custom::placeholder {
    color: #475569;
  }

  .form-control-custom:focus {
    border-color: #0ea5e9 !important;
    background: rgba(15, 23, 42, 0.8) !important;
    box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15) !important;
  }

  .form-control-custom:focus + i {
    color: #0ea5e9;
  }

  .checkbox-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 25px;
  }

  .custom-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    user-select: none;
  }

  .custom-checkbox input {
    accent-color: #0ea5e9;
    width: 16px;
    height: 16px;
    border-radius: 4px;
  }

  .btn-submit {
    width: 100%;
    background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
    border: none;
    border-radius: 14px;
    padding: 14px;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(14, 165, 233, 0.25);
  }

  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
    opacity: 0.95;
  }

  .btn-submit:active {
    transform: translateY(0);
  }

  .alert-custom {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #fca5a5;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    padding: 12px 16px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
</style>
</head>
<body>

<div class="bg-shape-1"></div>
<div class="bg-shape-2"></div>

<div class="login-container">
  <div class="brand-header">
    <div class="brand-logo-container">
      <i class="fa fa-car"></i>
    </div>
    <h4>SIAP ADMINISTRATOR</h4>
    <p>Masuk untuk mengelola data sistem parkir</p>
  </div>

  @if(session('message'))
    <div class="alert-custom">
      <i class="fa fa-exclamation-circle"></i>
      <span>{{ session('message') }}</span>
    </div>
  @endif

  <form action="{{ $action }}" method="post">
    @csrf
    <div class="form-group">
      <label for="username">Username</label>
      <div class="input-wrapper">
        <input type="text" id="username" name="username" class="form-control-custom" placeholder="Masukkan username Anda" required autocomplete="off">
        <i class="fa fa-user-o"></i>
      </div>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-wrapper">
        <input type="password" id="password" name="password" class="form-control-custom" placeholder="Masukkan password Anda" required>
        <i class="fa fa-key"></i>
      </div>
    </div>

    <div class="checkbox-wrapper">
      <label class="custom-checkbox">
        <input type="checkbox" name="remember">
        <span>Ingat Saya</span>
      </label>
    </div>

    <button type="submit" class="btn-submit">{{ $button }}</button>
  </form>
</div>

<!-- jQuery 3 --> 
<script src="{{ asset('template/js/jquery.min.js') }}"></script> 
</body>
</html>
