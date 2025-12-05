<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Quiz Result #{{ $result->id }}</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_quiz_result_show.css') }}">
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('Logotype White.png') }}" alt="SAFF &amp; Co Admin">
      </div>
      <ul class="sidebar-menu">
        <li><a href="{{ route('admin.quiz_results.index') }}">📊 Dashboard</a></li>
        <li><a href="{{ route('admin.quiz_results.index') }}" class="active">📋 Results</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <h1>Result Details</h1>
        <a href="{{ route('admin.quiz_results.index') }}" class="back-link">← Back to Results</a>
      </div>

      <div class="detail-container">
        <!-- Header -->
        <div class="detail-header">
          <h2>Result #{{ $result->id }}</h2>
          <div class="detail-badge">
            📊 {{ $result->final_category }}
          </div>
        </div>

        <!-- User & Category Section -->
        <div class="detail-section">
          <div class="detail-section-title">📝 Summary</div>
          <div class="detail-row">
            <div class="detail-label">User</div>
            <div class="detail-value">{{ $result->user?->email ?? 'Guest' }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Category</div>
            <div class="detail-value">{{ $result->final_category }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Category Name</div>
            <div class="detail-value"><strong>{{ $result->final_category_name }}</strong></div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Submitted</div>
            <div class="detail-value">{{ $result->created_at->format('d M Y, H:i:s') }}</div>
          </div>
        </div>

        <!-- Answers Section -->
        <div class="detail-section">
          <div class="detail-section-title">✏️ Answers</div>
          <div class="answers-grid">
            <div class="answer-card">
              <div class="answer-card-label">Q1: Season Identity</div>
              <div class="answer-card-value">{{ $result->q1 ?: 'N/A' }}</div>
            </div>
            <div class="answer-card">
              <div class="answer-card-label">Q2: Collection</div>
              <div class="answer-card-value">{{ $result->q2 ?: 'N/A' }}</div>
            </div>
            <div class="answer-card">
              <div class="answer-card-label">Q3: Destination</div>
              <div class="answer-card-value">{{ $result->q3 ?: 'N/A' }}</div>
            </div>
            <div class="answer-card">
              <div class="answer-card-label">Q4: Cloud Mist</div>
              <div class="answer-card-value">{{ $result->q4 ?: 'N/A' }}</div>
            </div>
            <div class="answer-card">
              <div class="answer-card-label">Q5: Spell</div>
              <div class="answer-card-value">{{ $result->q5 ?: 'N/A' }}</div>
            </div>
            <div class="answer-card">
              <div class="answer-card-label">Q6: Home Word</div>
              <div class="answer-card-value">{{ $result->q6 ?: 'N/A' }}</div>
            </div>
          </div>
        </div>

        <!-- Scores Section -->
        <div class="detail-section">
          <div class="detail-section-title">🎯 Scores</div>
          <div class="scores-container">
            <div class="score-item">
              <div class="score-letter">A</div>
              <div class="score-number">{{ $result->score_a }}</div>
            </div>
            <div class="score-item">
              <div class="score-letter">B</div>
              <div class="score-number">{{ $result->score_b }}</div>
            </div>
            <div class="score-item">
              <div class="score-letter">C</div>
              <div class="score-number">{{ $result->score_c }}</div>
            </div>
            <div class="score-item">
              <div class="score-letter">D</div>
              <div class="score-number">{{ $result->score_d }}</div>
            </div>
            <div class="score-item">
              <div class="score-letter">E</div>
              <div class="score-number">{{ $result->score_e }}</div>
            </div>
          </div>
        </div>

        <!-- Rolling List Section -->
        <div class="detail-section">
          <div class="detail-section-title">🎁 Recommended Items</div>
          <div class="rolling-list-box">
            {{ $result->rolling_list ?: 'No recommendations available' }}
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
