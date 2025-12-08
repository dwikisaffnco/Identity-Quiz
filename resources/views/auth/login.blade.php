<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — SAFF & Co</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth_login.css') }}">
  </head>
  <body>
    <div class="layout">
      <div class="card-area">
        <div class="card">
          <div style="text-align:center;margin-bottom:16px;">
            <img src="{{ asset('Logogram Black.png') }}" alt="SAFF &amp; Co" style="max-width:160px;height:auto;">
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
