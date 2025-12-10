<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — Edit Quiz Result #{{ $result->id }}</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_quiz_result_show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_quiz_result_edit.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('Logotype White.png') }}" alt="SAFF &amp; Co Admin">
      </div>
      <ul class="sidebar-menu">
        <li><a href="{{ route('admin.quiz_results.index') }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.quiz_results.index') }}" class="active"><i class="fa-solid fa-table"></i> Results</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <h1>Edit Result</h1>
        <a href="{{ route('admin.quiz_results.show', $result->id) }}" class="back-link">← Back to Result</a>
      </div>

      <div class="detail-container">
        @if ($errors->any())
          <div class="alert alert-error">
            <strong>Error:</strong>
            <ul style="margin-top: 8px; padding-left: 20px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.quiz_results.update', $result->id) }}">
          @csrf
          @method('PUT')

          <!-- Header -->
          <div class="detail-header">
            <h2>Result #{{ $result->id }}</h2>
            <div class="detail-badge">
              <i class="fa-solid fa-chart-pie"></i> {{ $result->final_category }}
            </div>
          </div>

          <!-- Summary Section (read-only, sama seperti view) -->
          <div class="detail-section">
            <div class="detail-section-title"><i class="fa-regular fa-clipboard"></i> Summary</div>
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

          <!-- Answers Section (editable) -->
          <div class="detail-section">
            <div class="detail-section-title"><i class="fa-regular fa-pen-to-square"></i> Answers</div>
            <div class="answers-grid answers-grid-edit">
              <div class="answer-card">
                <div class="answer-card-label">Q1: Season Identity</div>
                <div class="answer-card-value">
                  <input type="text" name="q1" value="{{ old('q1', $result->q1) }}" placeholder="A, B, C, or D">
                </div>
              </div>
              <div class="answer-card">
                <div class="answer-card-label">Q2: Collection</div>
                <div class="answer-card-value">
                  <input type="text" name="q2" value="{{ old('q2', $result->q2) }}" placeholder="Enter collection name">
                </div>
              </div>
              <div class="answer-card">
                <div class="answer-card-label">Q3: Destination</div>
                <div class="answer-card-value">
                  <input type="text" name="q3" value="{{ old('q3', $result->q3) }}" placeholder="A, B, C, or D">
                </div>
              </div>
              <div class="answer-card">
                <div class="answer-card-label">Q4: Cloud Mist</div>
                <div class="answer-card-value">
                  <input type="text" name="q4" value="{{ old('q4', $result->q4) }}" placeholder="A, B, C, D, or E">
                </div>
              </div>
              <div class="answer-card">
                <div class="answer-card-label">Q5: Spell</div>
                <div class="answer-card-value">
                  <input type="text" name="q5" value="{{ old('q5', $result->q5) }}" placeholder="A, B, C, or D">
                </div>
              </div>
              <div class="answer-card">
                <div class="answer-card-label">Q6: Home Word</div>
                <div class="answer-card-value">
                  <input type="text" name="q6" value="{{ old('q6', $result->q6) }}" placeholder="A, B, C, or D">
                </div>
              </div>
            </div>
          </div>

          <!-- Category Section (editable) -->
          <div class="detail-section">
            <div class="detail-section-title"><i class="fa-solid fa-tag"></i> Category</div>
            <div class="answers-grid answers-grid-edit">
              <div class="answer-card">
                <div class="answer-card-label">Final Category</div>
                <div class="answer-card-value">
                  <input type="text" name="final_category" value="{{ old('final_category', $result->final_category) }}" placeholder="A, B, C, D, or E">
                </div>
              </div>
              <div class="answer-card">
                <div class="answer-card-label">Category Name</div>
                <div class="answer-card-value">
                  <input type="text" name="final_category_name" value="{{ old('final_category_name', $result->final_category_name) }}" placeholder="Category name">
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="detail-section">
            <div class="detail-section-title"><i class="fa-regular fa-floppy-disk"></i> Actions</div>
            <div class="button-group">
              <a href="{{ route('admin.quiz_results.show', $result->id) }}" class="btn btn-cancel">Cancel</a>
              <button type="submit" class="btn btn-save"><i class="fa-regular fa-floppy-disk"></i> Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
