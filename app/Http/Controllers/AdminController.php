<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }
    public function showDashboard()
    {

        $totalUsers = User::count();
        $totalActiveUsers = User::where('status', 1)->count();
        $totalInActiveUsers = User::where('status', 0)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalActiveUsers', 'totalInActiveUsers'));
    }

    public function viewUser()
    {
        $latestUpdatedUser = User::latest()->first();
        $users = User::all();
        return view('admin.user', compact('users', 'latestUpdatedUser'));
    }
    public function allUser()
    {
        $latestUpdatedUser = User::latest()->first();
        $users = User::all();
        return view('admin.alluser', compact('users', 'latestUpdatedUser'));
    }
    public function ViewProfile()
    {
        return view('admin.profile');
    }

    public function changePassword()
    {
        return view('admin.changePassword');
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $newpassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');
        // Verify the current password
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Your old password is incorrect.']);
        } elseif ($newpassword !== $confirmPassword) {
            return redirect()->back()->withErrors(['password_mismatch' => 'The passwords do not match.']);
        } else {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:6|different:old_password',
                'confirm_password' => 'required|same:new_password',
            ]);

            // Update the password
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return redirect()->back()->with('status', 'Password updated successfully.');
        }
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'role' => 'required'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->save();
        return redirect()->back()->with('status', 'user added successfully!');
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string',
        ]);

        // Get the user ID from the form or any other source
        $userId = $request->input('id');

        // Find the user by ID
        $user = User::findOrFail($userId);

        // Update the user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();
        // Redirect back with a success message
        return redirect()->back()->with('status', 'User updated successfully.');
    }

    public function activeDeactive($userID)
    {
        $user = User::find($userID);
        if ($user) {
            if ($user->status) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }
            $user->save();
        }

        return back()->with('success', 'user status change correctly');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'required|file|max:300'

        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Update the user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('photos'); // Store the photo in the "photos" directory
            $user->photo = $photoPath;
        }

        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
