<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Quiz Result #{{ $result->id }}</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_quiz_result_edit.css') }}">
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
        <h1>Edit Result</h1>
        <a href="{{ route('admin.quiz_results.show', $result->id) }}" class="back-link">← Back</a>
      </div>

      <div class="edit-container">
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
          <div class="edit-header">
            <h2>Result #{{ $result->id }}</h2>
            <div style="font-size: 14px; color: #718096;">
              Category: <strong>{{ $result->final_category_name }}</strong>
            </div>
          </div>

          <!-- Answers Section -->
          <div class="form-section">
            <div class="form-section-title">✏️ Answers</div>
            <div class="form-grid">
              <div class="form-group">
                <label for="q1">Q1: Season Identity</label>
                <input type="text" id="q1" name="q1" value="{{ old('q1', $result->q1) }}" placeholder="A, B, C, or D">
              </div>
              <div class="form-group">
                <label for="q2">Q2: Collection</label>
                <input type="text" id="q2" name="q2" value="{{ old('q2', $result->q2) }}" placeholder="Enter collection name">
              </div>
              <div class="form-group">
                <label for="q3">Q3: Destination</label>
                <input type="text" id="q3" name="q3" value="{{ old('q3', $result->q3) }}" placeholder="A, B, C, or D">
              </div>
              <div class="form-group">
                <label for="q4">Q4: Cloud Mist</label>
                <input type="text" id="q4" name="q4" value="{{ old('q4', $result->q4) }}" placeholder="A, B, C, D, or E">
              </div>
              <div class="form-group">
                <label for="q5">Q5: Spell</label>
                <input type="text" id="q5" name="q5" value="{{ old('q5', $result->q5) }}" placeholder="A, B, C, or D">
              </div>
              <div class="form-group">
                <label for="q6">Q6: Home Word</label>
                <input type="text" id="q6" name="q6" value="{{ old('q6', $result->q6) }}" placeholder="A, B, C, or D">
              </div>
            </div>
          </div>

          <!-- Category Section -->
          <div class="form-section">
            <div class="form-section-title">🏷️ Category</div>
            <div class="form-grid">
              <div class="form-group">
                <label for="final_category">Final Category</label>
                <input type="text" id="final_category" name="final_category" value="{{ old('final_category', $result->final_category) }}" placeholder="A, B, C, D, or E">
              </div>
              <div class="form-group">
                <label for="final_category_name">Category Name</label>
                <input type="text" id="final_category_name" name="final_category_name" value="{{ old('final_category_name', $result->final_category_name) }}" placeholder="Category name">
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="button-group">
            <a href="{{ route('admin.quiz_results.show', $result->id) }}" class="btn btn-cancel">Cancel</a>
            <button type="submit" class="btn btn-save">💾 Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
