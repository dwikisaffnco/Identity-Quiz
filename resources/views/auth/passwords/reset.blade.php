<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set new password — SAFF & Co</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth_password_reset.css') }}">
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
