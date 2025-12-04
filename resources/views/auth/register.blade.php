<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — SAFF & Co Quiz</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        background: #1a1a2e;
        min-height: 100vh;
      }

      .register-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        height: 100vh;
        overflow: hidden;
      }

      .hero-side {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 60px 40px;
        color: white;
        position: relative;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 1200 800' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3Cstyle%3E.mountain1%7Bfill:%23764ba2;opacity:0.3%7D.mountain2%7Bfill:%236b63a0;opacity:0.5%7D%3C/style%3E%3C/defs%3E%3Cpath class='mountain1' d='M0 600 Q300 200 600 500 T1200 600 L1200 800 L0 800 Z'/%3E%3Cpath class='mountain2' d='M100 700 Q400 300 800 600 T1200 800 L1200 800 L0 800 Z'/%3E%3C/svg%3E");
        background-size: cover;
        background-position: center;
      }

      .hero-side::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
      }

      .hero-header {
        position: relative;
        z-index: 1;
      }

      .hero-logo {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
        letter-spacing: 1px;
      }

      .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
      }

      .back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
      }

      .hero-content {
        position: relative;
        z-index: 1;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      .hero-tagline {
        font-size: 48px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 20px;
      }

      .hero-description {
        font-size: 16px;
        opacity: 0.9;
        line-height: 1.6;
      }

      .hero-progress {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
      }

      .progress-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
      }

      .progress-dot.active {
        background: white;
        width: 24px;
        border-radius: 4px;
      }

      .form-side {
        background: #252542;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 60px 40px;
      }

      .form-wrapper {
        width: 100%;
        max-width: 420px;
      }

      .form-title {
        font-size: 36px;
        font-weight: 700;
        color: white;
        margin-bottom: 12px;
      }

      .form-subtitle {
        font-size: 14px;
        color: #a0aec0;
        margin-bottom: 32px;
      }

      .form-subtitle a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
      }

      .form-subtitle a:hover {
        text-decoration: underline;
      }

      .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .form-row .form-group {
        margin-bottom: 0;
      }

      .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #cbd5e0;
        margin-bottom: 8px;
      }

      .form-group input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #3f4557;
        border-radius: 8px;
        font-size: 14px;
        background: #2d2d47;
        color: white;
        transition: all 0.3s ease;
      }

      .form-group input::placeholder {
        color: #718096;
      }

      .form-group input:focus {
        outline: none;
        border-color: #667eea;
        background: #333349;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      }

      .form-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        cursor: pointer;
        accent-color: #667eea;
      }

      .checkbox-label {
        display: flex;
        align-items: center;
        font-size: 13px;
        color: #cbd5e0;
        cursor: pointer;
      }

      .checkbox-label a {
        color: #667eea;
        text-decoration: none;
        margin-left: 4px;
      }

      .checkbox-label a:hover {
        text-decoration: underline;
      }

      .submit-btn {
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 24px;
      }

      .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(102, 126, 234, 0.4);
      }

      .submit-btn:active {
        transform: translateY(0);
      }

      .divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 28px 0;
        color: #718096;
        font-size: 13px;
      }

      .divider::before,
      .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #3f4557;
      }

      .social-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
      }

      .social-btn {
        padding: 12px 16px;
        background: #2d2d47;
        border: 1px solid #3f4557;
        border-radius: 8px;
        color: #cbd5e0;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
      }

      .social-btn:hover {
        background: #333349;
        border-color: #667eea;
      }

      .error-box {
        background: rgba(245, 101, 101, 0.1);
        color: #fc8181;
        padding: 12px 14px;
        border-radius: 8px;
        margin-bottom: 24px;
        border: 1px solid rgba(252, 129, 129, 0.2);
        font-size: 13px;
      }

      .error-box ul {
        margin: 8px 0 0 20px;
        padding: 0;
      }

      .error-box li {
        list-style: disc;
        margin-bottom: 4px;
      }

      @media (max-width: 1024px) {
        .register-container {
          grid-template-columns: 1fr;
          height: auto;
        }

        .hero-side {
          display: none;
        }

        .form-side {
          min-height: 100vh;
          padding: 40px 20px;
        }

        .form-wrapper {
          max-width: 100%;
        }
      }

      @media (max-width: 768px) {
        .form-side {
          padding: 30px 20px;
        }

        .form-title {
          font-size: 28px;
        }

        .form-row {
          grid-template-columns: 1fr;
        }

        .hero-tagline {
          font-size: 36px;
        }
      }
    </style>
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
