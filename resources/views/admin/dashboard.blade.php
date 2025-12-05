<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('Logogram White.png') }}">
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css  ') }}">
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
        fetch('{{ route('admin.quiz_results.export') }}', {
          method: 'GET',
          headers: {
            'Accept': 'text/csv',
          },
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Failed to export CSV');
            }
            return response.blob();
          })
          .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'quiz_results_{{ now()->format('Ymd_His') }}.csv';
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
          })
          .catch(error => {
            console.error('Error exporting CSV:', error);
            alert('Failed to export CSV');
          });
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
          Swal.fire({
            title: 'Sending...',
            text: 'Please wait while we send data to Google Sheets.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });

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
              Swal.close();
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
              Swal.close();
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
