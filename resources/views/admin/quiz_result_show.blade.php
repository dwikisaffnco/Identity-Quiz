<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Quiz Result #{{ $result->id }}</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        background: #111;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        color: #e5e7eb;
      }

      .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 260px;
        height: 100vh;
        background: #000;
        border-right: 1px solid #27272f;
        padding: 30px 20px;
        overflow-y: auto;
        z-index: 1000;
      }

      .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 40px;
        font-size: 20px;
        font-weight: 700;
        color: #f9fafb;
      }

      .sidebar-brand img {
        height: 28px;
        width: auto;
        display: block;
      }

      .sidebar-menu {
        list-style: none;
      }

      .sidebar-menu li {
        margin-bottom: 12px;
      }

      .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #9ca3af;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
      }

      .sidebar-menu a:hover,
      .sidebar-menu a.active {
        background: #27272f;
        color: #f9fafb;
      }

      .main-content {
        margin-left: 260px;
        padding: 40px;
        color: #e5e7eb;
      }

      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
      }

      .header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #f9fafb;
      }

      .back-link {
        color: #e5e7eb;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
      }

      .back-link:hover {
        gap: 12px;
      }

      .detail-container {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        border: 1px solid #e5e7eb;
        padding: 40px;
        max-width: 900px;
      }

      .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 24px;
        margin-bottom: 32px;
      }

      .detail-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #111827;
      }

      .detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #000 0%, #444 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
      }

      .detail-section {
        margin-bottom: 32px;
      }

      .detail-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e5e7eb;
      }

      .detail-row {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
      }

      .detail-row:last-child {
        border-bottom: none;
      }

      .detail-label {
        font-weight: 600;
        color: #6b7280;
        font-size: 14px;
      }

      .detail-value {
        color: #111827;
        font-size: 14px;
      }

      .answers-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
      }

      .answer-card {
        background: #f5f5f5;
        padding: 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
      }

      .answer-card-label {
        font-size: 12px;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
      }

      .answer-card-value {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
      }

      .scores-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
      }

      .score-item {
        background: linear-gradient(135deg, #000 0%, #444 100%);
        color: white;
        padding: 16px;
        border-radius: 8px;
        text-align: center;
      }

      .score-letter {
        font-size: 12px;
        opacity: 0.9;
        margin-bottom: 8px;
      }

      .score-number {
        font-size: 28px;
        font-weight: 700;
      }

      .rolling-list-box {
        background: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #111827;
        color: #111827;
        line-height: 1.6;
      }

      @media (max-width: 1024px) {
        .sidebar {
          width: 220px;
        }

        .main-content {
          margin-left: 220px;
          padding: 30px;
        }
      }

      @media (max-width: 768px) {
        .sidebar {
          transform: translateX(-100%);
        }

        .main-content {
          margin-left: 0;
          padding: 20px;
        }

        .answers-grid {
          grid-template-columns: 1fr;
        }

        .scores-container {
          grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        }

        .detail-row {
          grid-template-columns: 1fr;
        }
      }
    </style>
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
