<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-brand">
        <img src="{{ asset('Logotype White.png') }}" alt="SAFF &amp; Co Admin">
      </div>
      <ul class="sidebar-menu">
        <li><a href="{{ route('admin.quiz_results.index') }}" class="active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.quiz_results.index') }}"><i class="fa-solid fa-table"></i> Results</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header">
        <div style="display:flex;align-items:center;gap:16px;width:100%;justify-content:space-between;">
          <div style="display:flex;align-items:center;gap:16px;">
            <button type="button" class="sidebar-toggle" aria-label="Toggle navigation">
              <span></span>
            </button>
            <h1>Dashboard</h1>
          </div>
        </div>
        <div class="profile-menu">
          <div class="profile-info">
            <p>{{ Auth::user()->name }}</p>
            <p>{{ Auth::user()->email }}</p>
          </div>
          <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
          </form>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-card-header">
            <div class="stat-card-title">Total Responses</div>
            <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
          </div>
          <div class="stat-number">{{ $totalResponses }}</div>
          <div class="stat-change">✓ All time</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-header">
            <div class="stat-card-title">Categories</div>
            <div class="stat-icon"><i class="fa-solid fa-tags"></i></div>
          </div>
          <div class="stat-number">5</div>
          <div class="stat-change">✓ A, B, C, D, E</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-header">
            <div class="stat-card-title">Admin</div>
            <div class="stat-icon"><i class="fa-solid fa-user"></i></div>
          </div>
          <div class="stat-number">{{ Auth::user()->name }}</div>
          <div class="stat-change">✓ Logged in</div>
        </div>
      </div>

      <!-- Results Section -->
      <div class="section-header">
        <h2>Quiz Results</h2>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
          {{-- <button onclick="exportAllCSV()" class="export-btn" style="background:#fff;color:#111827;border:1px solid #e5e7eb;">Export to CSV</button> --}}
          <button type="button" onclick="window.open('https://docs.google.com/spreadsheets/d/1QkIIXNfVRwYPIw9WE3ixGVQQHT88IpG12HB3Xc8ShEY/edit?gid=946384394#gid=946384394', '_blank');" class="export-btn" style="background:#fff;color:#111827;border:1px solid #e5e7eb;width:auto;">View Sheets</button>
          <button onclick="exportAllToSheets()" class="export-btn" style="background:#fff;color:#111827;border:1px solid #e5e7eb;width:auto;">Send to Google Sheets</button>
        </div>
      </div>

      <div class="results-container">
        <div class="table-responsive">
        <table class="results-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Category</th>
              <th>Category Name</th>
              <th>Submitted</th>
              <th style="text-align: center;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($results as $r)
              <tr>
                <td>#{{ $r->id }}</td>
                <td>{{ $r->user?->email ?? 'Guest' }}</td>
                <td><strong>{{ $r->final_category }}</strong></td>
                <td>{{ $r->final_category_name }}</td>
                <td>{{ $r->created_at->format('d M Y, H:i') }}</td>
                <td style="text-align: center;">
                  <div class="action-buttons">
                    <a href="{{ route('admin.quiz_results.show', $r->id) }}" class="action-btn btn-view"><i class="fa-regular fa-eye"></i> View</a>
                    <a href="{{ route('admin.quiz_results.edit', $r->id) }}" class="action-btn btn-edit"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                    <a href="#" onclick="deleteResult({{ $r->id }}); return false;" class="action-btn btn-delete"><i class="fa-regular fa-trash-can"></i> Delete</a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
                  No quiz results yet. Responses will appear here.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
        </div>

        <div class="pagination-wrapper">
          {{ $results->links() }}
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      window.DASHBOARD_CONFIG = {
        totalResults: {{ $totalResponses }},
        exportCsvUrl: '{{ route('admin.quiz_results.export') }}',
        exportCsvFilename: 'quiz_results_{{ now()->format('Ymd_His') }}.csv',
        exportSheetsUrl: '{{ route('admin.quiz_results.export_sheets') }}',
      };
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
  </body>
</html>
