<?php /** @var \Illuminate\Pagination\LengthAwarePaginator $results */ ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin  Quiz Results</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <style>
      *{margin:0;padding:0;box-sizing:border-box}
      html,body{height:100%}
      body{font-family:'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;background:#111;color:#e5e7eb}
      .layout{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px}
      .card-area{background:#ffffff;border-radius:16px;box-shadow:0 18px 45px rgba(0,0,0,0.35);padding:28px 32px;max-width:1100px;width:100%}
      .header-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
      .header-row h1{font-size:22px;color:#111;margin:0}
      .logout-btn{background:linear-gradient(90deg,#000,#444);color:#fff;border:none;padding:10px 22px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer}
      .table-responsive{width:100%;overflow-x:auto}
      .results-table{width:100%;border-collapse:collapse;margin-top:8px;min-width:700px}
      .results-table thead{background:#f5f5f5;border-bottom:2px solid #e5e7eb}
      .results-table th{padding:12px 14px;text-align:left;font-size:12px;font-weight:700;color:#4b5563;text-transform:uppercase;letter-spacing:.5px}
      .results-table td{padding:12px 14px;border-bottom:1px solid #f3f4f6;font-size:13px;color:#111827}
      .results-table tbody tr:hover{background:#f5f5f5}
      .view-link{display:inline-block;padding:6px 12px;border-radius:6px;background:#e5e5e5;color:#111827;text-decoration:none;font-size:12px;font-weight:600}
      .view-link:hover{background:#111827;color:#ffffff}
      .pagination-wrap{margin-top:18px}
      .pagination-wrap nav{display:inline-block}
      @media(max-width:768px){
        .layout{padding:20px}
        .card-area{padding:20px}
        .results-table th,
        .results-table td{padding:8px 10px;font-size:12px}
        .view-link{padding:4px 8px;font-size:11px}
      }
    </style>
  </head>
  <body>
    <div class="layout">
      <div class="card-area">
        <div class="header-row">
          <h1>Quiz Results</h1>
          <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
          </form>
        </div>

        <div class="table-responsive">
        <table class="results-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Final Category</th>
              <th>Final Name</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($results as $r)
              <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->user?->email ?? 'Guest' }}</td>
                <td>{{ $r->final_category }}</td>
                <td>{{ $r->final_category_name }}</td>
                <td>{{ $r->created_at }}</td>
                <td><a href="{{ route('admin.quiz_results.show', $r->id) }}" class="view-link">View</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>

        <div class="pagination-wrap">{{ $results->links() }}</div>
      </div>
    </div>
  </body>
  </html>
