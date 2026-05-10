<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-color: #1a1a2e;
            padding-top: 30px;
            color: #fff;
        }
        .container {
            max-width: 420px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Aligns items to the top so the text doesn't push the button down */
            margin-bottom: 24px;
            gap: 15px;
        }
        .header h6 {
            margin: 0;
            font-weight: 500;
            font-size: 0.95rem;
            line-height: 1.4;
            color: #e0e0e0;
        }

        .greeting-text {
            display: inline-block;
            padding: 4px 0;
        }
        .admin-badge {
            color: #764ba2;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 2px;
        }
        .note-card {
            background: #2e2e4e;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
            transition: all 0.2s ease;
        }
        .note-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,.3);
        }
        .note-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .note-content {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-bottom: 12px;
        }
        .empty-message {
            text-align: center;
            opacity: 0.8;
            margin-top: 20px;
        }
        .add-note-card {
            background: #2e2e4e;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }
        .form-control {
            background: #3a3a5e;
            border: none;
            color: #fff;
        }
        .form-control:focus {
            background: #3a3a5e;
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(118, 75, 162, 0.25);
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn-primary {
            background: #764ba2;
            border: none;
        }
        .btn-primary:hover {
            background: #5e3a8a;
        }
        .btn-outline-secondary {
            color: #fff;
            border-color: #764ba2;
        }
        .btn-outline-secondary:hover {
            background: #764ba2;
            color: #fff;
        }

        .btn-delete {
            background-color: #dc3545; /* Solid Red */
            color: white;
            border: none;
            font-weight: 500;
            padding: 8px;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-delete:hover {
            background-color: #a71d2a; /* Darker Red on hover */
            color: white;
            transform: translateY(-1px); /* Slight lift effect */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h6>@php 
                $user = auth()->user(); 
            @endphp

            @if($user->role == 1)
                <div class="greeting-text">
                    Hello, {{ $user->name }}, these are all the notes and their authors.
                </div>
            @else
                <div class="greeting-text">
                    Hello, {{ $user->name }}
                </div>
            @endif</h6>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
            </form>
        </div>
        <div class="add-note-card">
            <form method="POST" action="/notes">
                @csrf
                <div class="mb-2">
                    <input type="text" name="title" class="form-control form-control-lg" placeholder="Title" required>
                </div>
                <div class="mb-2">
                    <textarea name="content" class="form-control" rows="3" placeholder="Content" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Note</button>
            </form>
        </div>
        
        @if(isset($notes) && count($notes) > 0)
            @foreach($notes as $note)
                <div class="note-card">
                    <div class="note-title">{{ $note->title }}</div>
                    <div class="note-content">{{ $note->content }}</div>
                    @if(auth()->user()->role == 1)
                        <small class="text-light">
                            <strong>Author:</strong> {{ $note->user->name }}
                        </small>
                    @endif
                    <form method="POST" action="/notes/{{ $note->id }}" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-delete w-100">Delete</button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="empty-message">No notes yet. Add one above!</div>
        @endif
    </div>
</body>
</html>