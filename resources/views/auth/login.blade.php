<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
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
            flex-direction: column; /* Vertically stack items */
            justify-content: center;
            align-items: center;
            padding: 20px;
            gap: 15px; /* Subtle spacing between weather and login cards */
        }
        /* Style for the weather card */
        .glass-card {
            width: 100%;
            max-width: 400px;
            background: #2e2e4e;
            padding: 18px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
            box-sizing: border-box;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .card-body h5 {
            margin: 0 0 4px 0;
            font-weight: 600;
            font-size: 1.1rem;
            color: #e0e0e0;
        }
        .weather-temp {
            font-size: 1.8rem; 
            font-weight: bold;
            color: #764ba2;
            line-height: 1.2;
        }
        .weather-desc {
            text-transform: capitalize;
            color: #aaa;
            font-size: 0.85rem;
            margin-top: 2px;
        }
        /* Style for the login card */
        .auth-card {
            width: 100%;
            max-width: 400px;    
            background: #2e2e4e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
            box-sizing: border-box;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .auth-card h5 {
            color: #fff;
            margin-bottom: 24px;
            font-size: 1.2rem;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            padding: 15px; 
            font-size: 16px; 
            border: none;
            border-radius: 6px;
            background: #3a3a5e;
            color: #fff;
            box-sizing: border-box;
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
            color: #b583ff;
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
        <div class="glass-card shadow-lg">
            <div class="card-body text-center" id="weather">
                @if(isset($weather))
                    <h5>{{ $weather['city'] }}</h5>
                    <div style="font-size: 1.8rem; font-weight: bold; color:#764ba2">
                        {{ $weather['temp'] }}°C
                    </div>
                    <div style="text-transform: capitalize;">
                        {{ $weather['description'] }}
                    </div>
                @else
                    <div>Loading weather...</div>
                @endif
            </div>
        </div>

        <form method="POST" action="/login" class="auth-card">
            @csrf
            <h5 class="text-center" style="font-weight: 600;">Welcome!</h5>
            
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

    <script>
        async function loadWeather() {
            try {
                const res = await fetch('/weather', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                if (!res.ok) return;
                
                const data = await res.json();
                if (data.main && data.weather) {
                    const roundedTemp = Math.round(data.main.temp);
                    document.getElementById('weather').innerHTML = `
                        <h5>${data.name}</h5>
                        <div style="font-size:1.8rem;font-weight:bold; color:#764ba2;">
                            ${roundedTemp}°C
                        </div>
                        <div style="text-transform: capitalize;">
                            ${data.weather[0].description}
                        </div>
                    `;
                }
            } catch (error) {
                // Log the error but don't crash the UI
                console.error("Weather load failed:", error);
            }
        }
        loadWeather();
        setInterval(loadWeather, 60000);
    </script>
</body>
</html>