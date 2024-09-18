<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Model User
use Illuminate\Support\Facades\Log;



class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Request data:', $request->all());

        $credentials = $request->only('username', 'password');

        Log::info('Credentials:', $credentials);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->pass)) {
            Auth::login($user);

            if ($user->role === 'siswa') {
                return redirect()->route('siswa.showsiswa'); // Route untuk siswa
            } elseif ($user->role === 'mentor') {
                return redirect()->route('mentor.index'); // Route untuk mentor
            }
        } else {
            return redirect()->route('login')->with('error', 'Username atau password salah.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
