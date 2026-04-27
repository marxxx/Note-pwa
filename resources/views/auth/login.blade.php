<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-color: #1a1a2e !important;
            margin: 0;
            color: #fff;
        }
        .auth-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .auth-card {
            width: 100%;
            max-width: 400px;    
            background: #2e2e4e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            /* Fixed sizes here */
            padding: 15px; 
            font-size: 16px; 
            border: none;
            border-radius: 6px;
            background: #3a3a5e;
            color: #fff;
            box-sizing: border-box; /* Prevents input from overflowing */
            transition: background 0.3s ease;
        }
        .input-group input:focus {
            background: #44446e;
            outline: none;
            box-shadow: 0 0 0 2px #764ba2;
        }
        .input-group input::placeholder {
            color: #aaa;
        }
        .login-btn {
            width: 100%;
            padding: 15px;
            background: #764ba2;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .login-btn:hover {
            background: #5e3a8a;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #aaa;
        }
        .footer a {
            text-decoration: none;
            color: #764ba2;
            font-weight: 500;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .text-danger {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <form method="POST" action="{{ route('login') }}" class="auth-card">
            @csrf
            <h5 class="text-center mb-4" style="font-weight: 600;">Welcome!</h5>
            
            <div class="input-group">
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <button type="submit" class="login-btn">Login</button>
            
            <p class="footer">Don't have an account? <a href="{{ route('register')}}">Create an Account</a></p>
        </form>
    </div>
</body>
</html>