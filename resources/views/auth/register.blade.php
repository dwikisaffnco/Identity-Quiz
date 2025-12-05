<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — SAFF & Co Quiz</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth_register.css') }}">
  </head>
  <body>
    <div class="register-container">
      <!-- Hero Side -->
      <div class="hero-side">
        <div class="hero-header">
          <div class="hero-logo">🎯 SAFF & Co</div>
          <a href="/" class="back-btn">← Back to website</a>
        </div>

        <div class="hero-content">
          <div class="hero-tagline">Capturing Moments, Creating Memories</div>
          <div class="hero-description">
            Join our community and discover your unique identity profile through our interactive quiz.
          </div>
        </div>

        <div>
          <div class="hero-progress">
            <div class="progress-dot active"></div>
            <div class="progress-dot"></div>
            <div class="progress-dot"></div>
          </div>
        </div>
      </div>

      <!-- Form Side -->
      <div class="form-side">
        <div class="form-wrapper">
          <h1 class="form-title">Create an account</h1>
          <p class="form-subtitle">
            Already have an account? <a href="{{ route('login') }}">Log in</a>
          </p>

          @if ($errors->any())
            <div class="error-box">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
              <div class="form-group">
                <label for="name">First name</label>
                <input 
                  type="text" 
                  id="name" 
                  name="name" 
                  placeholder="Fletcher"
                  value="{{ old('name') }}"
                  required
                >
              </div>

              <div class="form-group">
                <label for="last_name">Last name</label>
                <input 
                  type="text" 
                  id="last_name" 
                  name="last_name" 
                  placeholder="Last name"
                  value="{{ old('last_name') }}"
                >
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="your@email.com"
                value="{{ old('email') }}"
                required
              >
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Enter your password"
                required
              >
            </div>

            <label class="checkbox-label">
              <input type="checkbox" name="agree_terms" required>
              I agree to the <a href="#">Terms & Conditions</a>
            </label>

            <button type="submit" class="submit-btn">Create account</button>

            <div class="divider">Or register with</div>

            <div class="social-buttons">
              <button type="button" class="social-btn" onclick="alert('Google registration not yet implemented')">
                <span>🔵</span> Google
              </button>
              <button type="button" class="social-btn" onclick="alert('Apple registration not yet implemented')">
                <span>🍎</span> Apple
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
