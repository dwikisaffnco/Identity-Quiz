<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password  SAFF & Co</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <style>
      *{margin:0;padding:0;box-sizing:border-box}
      html,body{height:100%}
      body{font-family:'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;background:#111}
      .layout{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px}
      .card-area{background:#ffffff;display:flex;align-items:center;justify-content:center;padding:40px;border-radius:12px;box-shadow:0 18px 45px rgba(0,0,0,0.3);max-width:420px;width:100%}
      .card{width:100%;max-width:380px}
      .card h1{font-size:22px;color:#111;margin-bottom:6px;font-weight:700}
      .card p{color:#666;font-size:13px;margin-bottom:24px}
      .form-group{margin-bottom:18px}
      .form-group label{display:block;font-size:12px;color:#222;margin-bottom:6px;font-weight:600}
      .form-group input{width:100%;padding:10px 12px;border:1px solid #d4d4d4;border-radius:6px;font-size:13px;background:#f5f5f5}
      .form-group input:focus{outline:none;border-color:#000;background:#ffffff;box-shadow:0 0 0 2px rgba(0,0,0,0.1)}
      .btn-submit{width:100%;padding:12px;background:linear-gradient(90deg,#000,#444);color:white;border:none;border-radius:6px;font-weight:600;font-size:14px;cursor:pointer;margin-top:8px}
      .btn-submit:hover{opacity:0.95}
      .meta{text-align:center;margin-top:16px;font-size:13px;color:#666}
      .meta a{color:#111;text-decoration:none;font-weight:600}
      .status-box{background:#f5f5f5;color:#065f46;padding:10px 12px;border-radius:6px;margin-bottom:16px;border-left:3px solid #16a34a}
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
          <h1>Reset password</h1>
          <p>Enter your email and we'll send a link to reset your password.</p>

          @if (session('status'))
            <div class="status-box">{{ session('status') }}</div>
          @endif

          @if ($errors->any())
            <div class="error-box">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
              <label for="email">E-mail Address</label>
              <input id="email" type="email" name="email" placeholder="E-mail Address" required value="{{ old('email') }}">
            </div>
            <button class="btn-submit" type="submit">Send reset link</button>
          </form>

          <div class="meta"><a href="{{ route('login') }}">Back to sign in</a></div>
        </div>
      </div>
    </div>
  </body>
</html>
