<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password  SAFF & Co</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth_password_email.css') }}">
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
