<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'admin_key' => 'nullable|string',
        ]);

        $role = 0; 
        if ($request->admin_key === 'admin123') {
            $role = 1; 
        }

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $role,
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
   public function showLogin()
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $city = 'Sogod, PH'; 
        $weather = null;

        try {
            // We use timeout(5) to prevent the 500 error during slow connections
            $response = Http::timeout(5)->withoutVerifying()->get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // If JavaScript fetches this, return JSON as per Step 5
                if (request()->expectsJson()) {
                    return response()->json($data);
                }

                $weather = [
                    'temp' => $data['main']['temp'],
                    'description' => $data['weather'][0]['description'],
                    'city' => $data['name']
                ];
            }
        } catch (\Exception $e) {
            // Catching the error prevents the 500 Internal Server Error
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Connection failed'], 504);
            }
            $weather = null;
        }

        return view('auth.login', compact('weather'));
    }

    public function getWeather()
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $city = 'Sogod, PH';

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        return $response->json(); 
    }

    
}