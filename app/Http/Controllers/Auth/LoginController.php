<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle the user authentication and redirection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $user = Auth::user();
    //     if ($user && $user->status === 1) {
    //         if ($user->role === 'admin') {
    //             return redirect()->route('admin.dashboard');
    //         } elseif ($user->role === 'supervisor') {
    //             return redirect()->route('supervisor.dashboard');
    //         } elseif ($user->role === 'expert') {
    //             return redirect()->route('expert.dashboard');
    //         } elseif ($user->role === 'dataencoder') {
    //             return redirect()->route('dataencoder.dashboard');
    //         } else {
    //             return redirect()->route('login')->with('error', 'Your password or email is incorrect.');
    //         }
    //     } else {
    //         return redirect()->route('login')->with('error', 'Your account is locked.');
    //     }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
