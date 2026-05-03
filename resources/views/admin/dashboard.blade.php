<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-color: #1a1a2e; /* Deep purple-blue dark mode bg */
            padding: 30px 15px;
            color: #fff;
        }
        .container-box {
            max-width: 700px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            gap: 15px;
        }
        .header h5 {
            margin: 0;
            font-weight: 500;
            font-size: 1.1rem;
            line-height: 1.4;
            color: #e0e0e0;
        }
        .header small {
            display: block;
            font-size: 0.85rem;
            opacity: 0.75;
            margin-top: 4px;
            color: #e0e0e0;
        }
        .admin-badge {
            background-color: #764ba2; /* Accent purple */
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            padding: 4px 8px;
            border-radius: 4px;
            vertical-align: middle;
        }
        .note-card {
            background: #2e2e4e; /* Dark theme card bg */
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
            transition: all 0.2s ease;
            border: none;
        }
        .note-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,.3);
        }
        .note-title {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #fff;
        }
        .note-content {
            font-size: 0.9rem;
            opacity: 0.85;
            margin-bottom: 12px;
            color: #e0e0e0;
        }
        .author-label {
            color: #b583ff; /* Lighter purple for dark mode contrast */
            font-size: 0.8rem;
            opacity: 0.9;
        }
        .empty-message {
            text-align: center;
            opacity: 0.8;
            margin-top: 30px;
            color: #e0e0e0;
        }
        .btn-outline-secondary {
            color: #fff;
            border-color: #764ba2;
        }
        .btn-outline-secondary:hover {
            background: #764ba2;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container-box">
    <div class="header">
        <div>
            <h5>Hello, {{ auth()->user()->name }} <span class="admin-badge">Admin</span></h5>
            <small>Overview: All system notes and their authors</small>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary px-3">Logout</button>
        </form>
    </div>

    @forelse($notes as $note)
        <div class="note-card">
            <div class="note-title">{{ $note->title }}</div>
            <div class="note-content">{{ $note->content }}</div>
            <div class="author-label">
                <strong>Author:</strong> {{ $note->user->name }}
            </div>
        </div>
    @empty
        <div class="empty-message">
            <p>No notes found in the system.</p>
        </div>
    @endforelse
</div>

</body>
</html>