<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-color: #1a1a2e;
            padding-top: 30px;
            color: #fff;
            margin: 0;
        }
        .auth-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .auth-card {
            width: 90%;
            max-width: 400px;    
            background: #2e2e4e;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
            box-sizing: border-box;
        }
        .input-group {
            margin-bottom: 15px;
        }
        /* Custom label for the admin key */
        .input-label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            color: #aaa;
        }
        .input-group input {
            width: 100%; /* Changed to 100% for better alignment */
            padding: 15px;
            border: none;
            border-radius: 5px;
            background: #3a3a5e;
            color: #fff;
            font-size: 16px;
            box-sizing: border-box; /* Ensures padding doesn't affect width */
        }
        .input-group input::placeholder {
            color: #aaa;
        }
        .register-btn {
            width: 100%;
            padding: 15px;
            background: #764ba2;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
        .register-btn:hover {
            background: #5e3a8a;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9rem;
            color: #aaa;
        }
        .footer a {
            text-decoration: none;
            color: #764ba2;
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
        h5 {
            text-align: center;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <form action="{{ route('register.store') }}" method="POST" class="auth-card">
            @csrf
            <h5 class="mb-4">Create Account</h5>
            
            <div class="input-group">
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <label for="admin_key" class="input-label">Admin Key (Optional)</label>
                <input type="password" name="admin_key" id="admin_key" placeholder="Enter secret key">
            </div>

            <button type="submit" class="register-btn">
                Register
            </button>
            
            <p class="footer">Already have an account? <a href="{{ route('login')}}">Login</a></p>
        </form>
    </div>
</body>
</html>