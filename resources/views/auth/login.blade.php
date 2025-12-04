<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — SAFF & Co</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <style>
      *{margin:0;padding:0;box-sizing:border-box}
      html,body{height:100%}
      body{font-family:'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;background:#111}
      .layout{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px}
      .card-area{background:#ffffff;display:flex;align-items:center;justify-content:center;padding:40px;border-radius:12px;box-shadow:0 18px 45px rgba(0,0,0,0.3);max-width:420px;width:100%}
      .card{width:100%;max-width:380px}
      .card h1{font-size:24px;color:#111;margin-bottom:6px;font-weight:700}
      .card p{color:#666;font-size:13px;margin-bottom:24px;text-align:center}
      .form-group{margin-bottom:18px}
      .form-group label{display:block;font-size:12px;color:#222;margin-bottom:6px;font-weight:600}
      .form-group input{width:100%;padding:10px 12px;border:1px solid #d4d4d4;border-radius:6px;font-size:13px;background:#f5f5f5}
      .form-group input:focus{outline:none;border-color:#000;background:#ffffff;box-shadow:0 0 0 2px rgba(0,0,0,0.1)}
      .password-wrapper{position:relative}
      .toggle-pwd{position:absolute;right:12px;top:30px;cursor:pointer;color:#444;font-size:12px;font-weight:600}
      .forgot-link{position:absolute;right:0;top:0;color:#111;text-decoration:none;font-size:12px;font-weight:600}
      .form-options{display:flex;align-items:center;margin:16px 0}
      .form-options input[type="checkbox"]{width:16px;height:16px;cursor:pointer;accent-color:#000}
      .form-options label{margin:0 0 0 6px;cursor:pointer;font-size:12px;color:#222}
      .btn-signin{width:100%;padding:12px;background:linear-gradient(90deg,#000,#444);color:white;border:none;border-radius:6px;font-weight:600;font-size:14px;cursor:pointer;margin-top:8px}
      .btn-signin:hover{opacity:0.95}
      .signup-link{text-align:center;margin-top:16px;font-size:13px;color:#666}
      .signup-link a{color:#111;text-decoration:none;font-weight:600}
      .error-box{background:#f5f5f5;color:#b91c1c;padding:10px 12px;border-radius:6px;margin-bottom:16px;border-left:3px solid #b91c1c}
      .error-box ul{margin:0;padding-left:18px}
      .error-box li{font-size:12px}
      @media(max-width:600px){
        .layout{padding:20px}
        .card-area{padding:24px}
      }
    </style>
  </head>
  <body>
    <div class="layout">
      <div class="card-area">
        <div class="card">
          <div style="text-align:center;margin-bottom:16px;">
            <img src="{{ asset('Logotype White.png') }}" alt="SAFF &amp; Co" style="max-width:160px;height:auto;">
          </div>
          <h1>Sign in</h1>
          <p>Silahkan Masuk ke dashboard form</p>

          @if ($errors->any())
            <div class="error-box">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              <label>User Name</label>
              <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            </div>

            <div class="form-group password-wrapper">
              <label>Password</label>
              <input type="password" id="password" name="password" placeholder="Password" required>
              <span class="toggle-pwd" onclick="document.getElementById('password').type = document.getElementById('password').type === 'password' ? 'text' : 'password'">SHOW</span>
              <a href="{{ url('/forgot-password') }}" class="forgot-link">Forgot Password?</a>
            </div>

            <div class="form-options">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">remember me</label>
            </div>

            <button type="submit" class="btn-signin">Sing in</button>
          </form>
      </div>
    </div>
  </body>
</html>
