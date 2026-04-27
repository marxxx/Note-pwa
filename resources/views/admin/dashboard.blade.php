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
            background: #b3b7c4; /* Soft slate background */
            padding: 30px;
            min-height: 100vh;
        }
        .container-box {
            max-width: 700px;
            margin: auto;
            background: rgba(255, 255, 255, 0.2); /* Translucent glass effect */
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .note-card {
            background: #ffffff;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 15px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }
        .note-card:hover {
            transform: scale(1.01);
        }
        h5 {
            color: #2d3436;
            font-weight: 600;
        }
        h5 small {
            color: #636e72;
            font-size: 0.85rem;
            font-weight: 400;
        }
        .author-label {
            color: #764ba2; /* Matches your previous theme color */
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<div class="container-box">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h5>Hello, {{ auth()->user()->name }} <span class="badge bg-dark ms-1">Admin</span></h5>
            <small>Overview: All system notes and their authors</small>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger px-3">Logout</button>
        </form>
    </div>

    @forelse($notes as $note)
        <div class="note-card">
            <h6 class="mb-1"><strong>Title:</strong> {{ $note->title }}</h6>
            <p class="text-muted mb-2"><strong>Description:</strong> {{ $note->content }}</p>
            <div class="author-label">
                <strong>Author:</strong> {{ $note->user->name }}
            </div>
        </div>
    @empty
        <div class="text-center py-4">
            <p class="text-muted">No notes found in the system.</p>
        </div>
    @endforelse
</div>

</body>
</html>