<?php /** @var \Illuminate\Pagination\LengthAwarePaginator $results */ ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin  Quiz Results</title>
    <link rel="stylesheet" href="{{ asset('css/stylce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_quiz_results.css') }}">
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
