<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — Edit Result #{{ $result->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
      }

      .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 260px;
        height: 100vh;
        background: white;
        border-right: 1px solid #e5e7eb;
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
        color: #1a202c;
      }

      .sidebar-brand span {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 900;
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
        color: #718096;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
      }

      .sidebar-menu a:hover,
      .sidebar-menu a.active {
        background: #f0f4ff;
        color: #667eea;
      }

      .main-content {
        margin-left: 260px;
        padding: 40px;
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
        color: #1a202c;
      }

      .back-link {
        color: #667eea;
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

      .edit-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        padding: 40px;
        max-width: 900px;
      }

      .edit-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 24px;
        margin-bottom: 32px;
      }

      .edit-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #1a202c;
      }

      .form-section {
        margin-bottom: 32px;
      }

      .form-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f4ff;
      }

      .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }

      .form-group {
        display: flex;
        flex-direction: column;
      }

      .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
      }

      .form-group input,
      .form-group textarea {
        padding: 12px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s ease;
      }

      .form-group input:focus,
      .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      }

      .form-group textarea {
        grid-column: 1 / -1;
        resize: vertical;
        min-height: 100px;
      }

      .button-group {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 32px;
        padding-top: 32px;
        border-top: 1px solid #e5e7eb;
      }

      .btn {
        padding: 12px 28px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
      }

      .btn-cancel {
        background: #f3f4f6;
        color: #6b7280;
      }

      .btn-cancel:hover {
        background: #e5e7eb;
      }

      .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
      }

      .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
      }

      .alert {
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
      }

      .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
      }

      .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
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

        .form-grid {
          grid-template-columns: 1fr;
        }

        .button-group {
          flex-direction: column;
        }

        .btn {
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-brand">
        <span>🎯</span>
        <div>Quiz Admin</div>
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
