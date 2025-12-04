<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
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

      .sidebar-toggle {
        display: none;
        width: 32px;
        height: 32px;
        border-radius: 999px;
        border: none;
        background: transparent;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        padding: 0;
      }

      .sidebar-toggle span {
        display: block;
        width: 18px;
        height: 2px;
        background: #e5e7eb;
        position: relative;
        border-radius: 999px;
      }

      .sidebar-toggle span::before,
      .sidebar-toggle span::after {
        content: '';
        position: absolute;
        left: 0;
        width: 18px;
        height: 2px;
        background: #e5e7eb;
        border-radius: 999px;
      }

      .sidebar-toggle span::before { top: -5px; }
      .sidebar-toggle span::after { top: 5px; }

      .profile-menu {
        display: flex;
        align-items: center;
        gap: 20px;
      }

      .profile-info {
        text-align: right;
      }

      .profile-info p:first-child {
        font-weight: 600;
        color: #f9fafb;
        font-size: 14px;
      }

      .profile-info p:last-child {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 2px;
      }

      .logout-btn {
        background: linear-gradient(135deg, #000 0%, #444 100%);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease;
      }

      .logout-btn:hover {
        transform: translateY(-2px);
      }

      .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
      }

      .stat-card {
        background: #ffffff;
        padding: 28px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
      }

      .stat-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.32);
        transform: translateY(-4px);
      }

      .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
      }

      .stat-card-title {
        font-size: 14px;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .stat-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #000 0%, #444 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
      }

      .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
      }

      .stat-change {
        font-size: 12px;
        color: #6b7280;
        font-weight: 600;
      }

      .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
      }

      .section-header h2 {
        font-size: 24px;
        font-weight: 700;
        color: #f9fafb;
      }

      .export-btn {
        background: linear-gradient(135deg, #000 0%, #444 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease;
      }

      .export-btn:hover {
        transform: translateY(-2px);
      }

      .results-container {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        border: 1px solid #e5e7eb;
        overflow: hidden;
      }

      .table-responsive {
        width: 100%;
        overflow-x: auto;
      }

      .results-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
      }

      .results-table thead {
        background: #f5f5f5;
        border-bottom: 2px solid #e5e7eb;
      }

      .results-table th {
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .results-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
        color: #111827;
      }

      .results-table tbody tr:hover {
        background: #f5f5f5;
      }

      .view-link {
        color: #111827;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
      }

      .view-link:hover {
        color: #000;
        text-decoration: underline;
      }

      .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: center;
      }

      .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
      }

      .btn-view {
        background: #e5e5e5;
        color: #111827;
      }

      .btn-view:hover {
        background: #111827;
        color: #ffffff;
      }

      .btn-edit {
        background: #e5e5e5;
        color: #111827;
      }

      .btn-edit:hover {
        background: #111827;
        color: #ffffff;
      }

      .btn-delete {
        background: #f3f4f6;
        color: #111827;
      }

      .btn-delete:hover {
        background: #000;
        color: #ffffff;
      }

      .pagination-wrapper {
        padding: 24px 20px;
        border-top: 1px solid #e5e7eb;
        background: #f5f5f5;
      }

      @media (max-width: 1024px) {
        .sidebar {
          width: 220px;
        }

        .main-content {
          margin-left: 220px;
          padding: 30px;
        }

        .header h1 {
          font-size: 24px;
        }
      }

      @media (max-width: 768px) {
        .sidebar {
          transform: translateX(-100%);
          transition: transform 0.3s ease;
        }

        .sidebar.open {
          transform: translateX(0);
        }

        .main-content {
          margin-left: 0;
          padding: 20px;
        }

        .stats-grid {
          grid-template-columns: 1fr;
        }

        .header {
          flex-direction: column;
          gap: 20px;
          align-items: flex-start;
        }

        .profile-menu {
          width: 100%;
          justify-content: space-between;
        }

        .results-table th,
        .results-table td {
          padding: 10px 12px;
          font-size: 12px;
        }

        .action-btn {
          padding: 4px 8px;
          font-size: 11px;
        }

        .sidebar-toggle {
          display: inline-flex;
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
        <li><a href="{{ route('admin.quiz_results.index') }}" class="active">📊 Dashboard</a></li>
        <li><a href="{{ route('admin.quiz_results.index') }}">📋 Results</a></li>
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
            <div class="stat-icon">📊</div>
          </div>
          <div class="stat-number">{{ $totalResponses }}</div>
          <div class="stat-change">✓ All time</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-header">
            <div class="stat-card-title">Categories</div>
            <div class="stat-icon">🏷️</div>
          </div>
          <div class="stat-number">5</div>
          <div class="stat-change">✓ A, B, C, D, E</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-header">
            <div class="stat-card-title">Admin</div>
            <div class="stat-icon">👤</div>
          </div>
          <div class="stat-number">{{ Auth::user()->name }}</div>
          <div class="stat-change">✓ Logged in</div>
        </div>
      </div>

      <!-- Results Section -->
      <div class="section-header">
        <h2>Quiz Results</h2>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
          <button onclick="exportAllCSV()" class="export-btn" style="background:#fff;color:#111827;border:1px solid #e5e7eb;">Export to CSV</button>
          <button onclick="exportAllToSheets()" class="export-btn" style="background:#fff;color:#111827;border:1px solid #e5e7eb;">Send to Google Sheets</button>
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
                    <a href="{{ route('admin.quiz_results.show', $r->id) }}" class="action-btn btn-view">View</a>
                    <a href="{{ route('admin.quiz_results.edit', $r->id) }}" class="action-btn btn-edit">Edit</a>
                    <a href="#" onclick="deleteResult({{ $r->id }}); return false;" class="action-btn btn-delete">Delete</a>
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
      // Mobile sidebar toggle
      const sidebar = document.querySelector('.sidebar');
      const toggleBtn = document.querySelector('.sidebar-toggle');

      if (sidebar && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
          sidebar.classList.toggle('open');
        });
      }

      function deleteResult(id) {
        Swal.fire({
          title: 'Delete Result?',
          text: 'This action cannot be undone.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc2626',
          cancelButtonColor: '#6b7280',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`/admin/quiz-results/${id}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'Accept': 'application/json'
              }
            })
              .then(res => res.json())
              .then(data => {
                if (data && data.ok) {
                  Swal.fire({
                    title: 'Successful!',
                    text: 'Result deleted successfully.',
                    icon: 'success',
                    confirmButtonColor: '#667eea'
                  }).then(() => {
                    window.location.reload();
                  });
                } else {
                  Swal.fire({
                    title: 'Error!',
                    text: 'Failed to delete result.',
                    icon: 'error',
                    confirmButtonColor: '#667eea'
                  });
                }
              })
              .catch(err => {
                console.error('Error:', err);
                Swal.fire({
                  title: 'Error!',
                  text: 'An error occurred while deleting.',
                  icon: 'error',
                  confirmButtonColor: '#667eea'
                });
              });
          }
        });
      }

      function exportAllCSV() {
        const totalResults = {{ $totalResponses }};
        
        if (totalResults === 0) {
          alert('No results to export');
          return;
        }
        window.location.href = '{{ route('admin.quiz_results.export') }}';
      }

      function exportAllToSheets() {
        const totalResults = {{ $totalResponses }};

        if (totalResults === 0) {
          Swal.fire({
            title: 'No results',
            text: 'There are no quiz results to send yet.',
            icon: 'info',
          });
          return;
        }

        Swal.fire({
          title: 'Send to Google Sheets?',
          text: 'All quiz results will be sent to Google Sheets.',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Yes, send',
        }).then((result) => {
          if (!result.isConfirmed) return;

          fetch('{{ route('admin.quiz_results.export_sheets') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
              'Accept': 'application/json',
            },
            body: JSON.stringify({}),
          })
            .then(res => res.json())
            .then(data => {
              if (data && data.ok) {
                Swal.fire({
                  title: 'Success!',
                  text: data.message || 'All results sent to Google Sheets.',
                  icon: 'success',
                });
              } else {
                Swal.fire({
                  title: 'Error',
                  text: (data && data.message) || 'Failed to send data to Google Sheets.',
                  icon: 'error',
                });
              }
            })
            .catch(err => {
              console.error('Error exporting to sheets:', err);
              Swal.fire({
                title: 'Error',
                text: 'An error occurred while sending data.',
                icon: 'error',
              });
            });
        });
      }
    </script>
  </body>
</html>
