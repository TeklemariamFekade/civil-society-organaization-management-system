<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectToIntendedDashboard();
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->onlyInput('email');
    }

    protected function redirectToIntendedDashboard()
    {
        $user = Auth::user();

        if ($user->status === 1) {
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'supervisor':
                    return redirect()->route('supervisor.dashboard');
                case 'expert':
                    return redirect()->route('expert.dashboard');
                case 'dataencoder':
                    return redirect()->route('dataencoder.dashboard');
                default:
                    return redirect()->route('login')->with('error', 'Your account is locked.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Your account is locked.');
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
