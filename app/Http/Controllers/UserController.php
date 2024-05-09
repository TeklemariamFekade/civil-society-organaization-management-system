<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->status === 1) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'supervisor') {
                return redirect()->route('supervisor.dashboard');
            } elseif ($user->role === 'expert') {
                return redirect()->route('expert.dashboard');
            } elseif ($user->role === 'dataencoder') {
                return redirect()->route('dataencoder.dashboard');
            } else {
                return redirect()->route('login')->with('error', 'Your password or email is incorrect.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Your account is locked.');
        }
    }
}
