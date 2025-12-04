<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set new password — SAFF & Co</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <style>
      body{font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial;background:#f6f7fb;min-height:100vh;display:flex;align-items:center;justify-content:center}
      .box{width:420px;background:white;padding:28px;border-radius:12px;box-shadow:0 8px 30px rgba(15,23,42,0.08)}
+      h1{margin:0 0 6px 0;font-size:20px}
+      p{color:#6b7280;margin-bottom:18px}
+      .input{width:100%;padding:12px;border-radius:10px;border:1px solid #e6e9ef;background:#f7f9fc;margin-bottom:12px}
+      .btn{width:100%;padding:12px;border-radius:10px;background:#3741ff;color:white;border:none;font-weight:600}
+      .meta{margin-top:12px;text-align:center;color:#6b7280}
    </style>
  </head>
  <body>
    <div class="box">
      <h1>Set a new password</h1>
      <p>Choose a strong password to protect your account.</p>

      @if ($errors->any())
        <div style="background:#fee2e2;color:#b91c1c;padding:10px;border-radius:8px;margin-bottom:12px">
          <ul style="margin:0;padding-left:18px">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input class="input" type="email" name="email" placeholder="E-mail Address" required value="{{ old('email') }}">
        <input class="input" type="password" name="password" placeholder="New password" required>
        <input class="input" type="password" name="password_confirmation" placeholder="Confirm password" required>
        <button class="btn" type="submit">Reset password</button>
      </form>

      <div class="meta"><a href="{{ route('login') }}">Back to sign in</a></div>
    </div>
  </body>
</html>
