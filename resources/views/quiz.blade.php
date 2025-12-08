<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SAFF &amp; Co – Identity Quiz 2026</title>

    <!-- Basic SEO -->
    <meta name="description" content="Discover your 2026 identity with SAFF &amp; Co. Answer a short quiz and get a personalized scent and lifestyle mood." />
    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="SAFF &amp; Co – Identity Quiz 2026" />
    <meta property="og:description" content="Discover your 2026 identity with SAFF &amp; Co. Answer a short quiz and get a personalized scent and lifestyle mood." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="SAFF &amp; Co" />
    <meta property="og:image" content="{{ asset('og/identity-quiz-2026.png') }}" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="SAFF &amp; Co – Identity Quiz 2026" />
    <meta name="twitter:description" content="Discover your 2026 identity with SAFF &amp; Co. Answer a short quiz and get a personalized scent and lifestyle mood." />
    <meta name="twitter:image" content="{{ asset('og/identity-quiz-2026.png') }}" />

    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}" />
  </head>
  <body>
    <div class="quiz-container">
      <h1>SAFF &amp; Co. – Identity Quiz 2026</h1>

      <!-- Q1 -->
      <div class="question">
        <h3>Q1: Choose your season identity, go!</h3>
        <label><input type="radio" name="q1" value="A" />A. Spring</label>
        <label><input type="radio" name="q1" value="B" />B. Summer</label>
        <label><input type="radio" name="q1" value="C" />C. Fall</label>
        <label><input type="radio" name="q1" value="D" />D. Winter</label>
      </div>

      <!-- Q2 -->
      <div class="question">
        <h3>Q2: Pick the first collection you want to try (free input).</h3>
        <input type="text" id="q2" placeholder="Type your choice..." />
      </div>

      <!-- Q3 -->
      <div class="question">
        <h3>Q3: Thinking about your next destination… it’s 2026!</h3>
        <label><input type="radio" name="q3" value="A" />A. Somewhere by the sea</label>
        <label><input type="radio" name="q3" value="B" />B. A long, slow vacation</label>
        <label><input type="radio" name="q3" value="C" />C. A spontaneous weekend trip</label>
        <label><input type="radio" name="q3" value="D" />D. Around the city</label>
      </div>

      <!-- Q4 -->
      <div class="question">
        <h3>Q4: Which Cloud Mist suits your personality?</h3>
        <label><input type="radio" name="q4" value="A" />A. Annabel Lee</label>
        <label><input type="radio" name="q4" value="B" />B. Remedia Amoris</label>
        <label><input type="radio" name="q4" value="C" />C. Sonnet 116</label>
        <label><input type="radio" name="q4" value="D" />D. Träumerei</label>
        <label><input type="radio" name="q4" value="E" />E. Am Kamin</label>
      </div>

      <!-- Q5 -->
      <div class="question">
        <h3>Q5: Pick your spell for the day!</h3>
        <label><input type="radio" name="q5" value="A" />A. Heavenly Potion (SOTB)</label>
        <label><input type="radio" name="q5" value="B" />B. Heavenly Potion (Ostara)</label>
        <label><input type="radio" name="q5" value="C" />C. Heavenly Potion (Las Pozas)</label>
        <label><input type="radio" name="q5" value="D" />D. Heavenly Potion (LOUI)</label>
      </div>

      <!-- Q6 -->
      <div class="question">
        <h3>Q6: One word that reminds you of “home”.</h3>
        <label><input type="radio" name="q6" value="A" />A. Love</label>
        <label><input type="radio" name="q6" value="B" />B. Joy</label>
        <label><input type="radio" name="q6" value="C" />C. Warm</label>
        <label><input type="radio" name="q6" value="D" />D. Safe</label>
      </div>

      <button onclick="calculateResult()">Submit</button>
    </div>

    <div id="quiz-thankyou" style="display:none;max-width:720px;margin:40px auto;padding:32px 28px;border-radius:16px;background:#f9fafb;box-shadow:0 18px 45px rgba(0,0,0,0.12);text-align:left;font-family:'Segoe UI',Roboto,Arial,sans-serif;">
      <h2 style="margin:0 0 8px 0;font-size:24px;color:#111;">SAFF &amp; Co. – Identity Quiz 2026</h2>
      <p style="margin:0 0 16px 0;font-size:16px;color:#111;">Your response has been recorded.</p>
      <button type="button" onclick="restartQuiz()" style="background:#111;color:#fff;border:none;border-radius:999px;padding:10px 18px;font-size:14px;font-weight:600;cursor:pointer;">Submit another response</button>
    </div>

    <footer style="margin:40px auto 24px auto;max-width:720px;text-align:center;font-size:12px;color:#6b7280;font-family:'Segoe UI',Roboto,Arial,sans-serif;">
      &copy; SAFF &amp; Co. 2026 · Identity Quiz
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
