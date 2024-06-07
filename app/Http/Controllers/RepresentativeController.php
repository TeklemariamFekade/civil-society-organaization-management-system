<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RepresentativeController extends Controller
{
    public function showLoginForm()
    {
        return view('representative.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('representative')->attempt($credentials)) {
            // Authentication passed, redirect to CSO dashboard
            return redirect()->route('representative.dashboard');
        }
        // Authentication failed, redirect back to login page with errors
        return redirect()->route('representative.login')->withErrors([
            'email' => 'Your password or email is incorrect.',
        ]);
    }



    public function register()
    {
        return view('representative.register');
    }

    public function showDashboard()
    {
        return view('representative.dashboard');
    }
    public function viewProfile()
    {
        return view('representative.profile');
    }
    public function showChangePasswordForm()
    {
        return view('representative.changePassword');
    }
    public function updatePassword(Request $request)
    {
        $representative = Auth::guard('representative')->user();
        $newpassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');
        // Verify the current password
        if (!Hash::check($request->input('old_password'), $representative->password)) {
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
            $representative->password = Hash::make($request->input('new_password'));
            $representative->save();

            return redirect()->back()->with('status', 'Password updated successfully.');
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|file|max:300',
        ]);

        // Get the currently authenticated representative
        $representative = Auth::guard('representative')->user();

        // Update the representative information
        $representative->name = $request->input('name');
        $representative->email = $request->input('email');
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('photos'); // Store the photo in the "photos" directory
            $representative->photo = $photoPath;
        }
        $representative->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    // elseif (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d).{6,}$/', $password)) {
    //     return redirect()->back()->withErrors(['password_requirements' => 'The password must be at least 6 characters long and must contain both letters and numbers.']);
    // }
    public function SignUp(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $confirmPassword = $request->input('confirm_password');

        if (Representative::where('email', $email)->exists()) {
            return redirect()->back()->withInput()->withErrors(['email' => 'This email is already registered.']);
        }

        if ($password !== $confirmPassword) {
            return redirect()->back()->withInput()->withErrors(['password_mismatch' => 'The passwords do not match.']);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:representatives,email',
            'password' => [
                'required',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
            'password.not_compromised' => 'The password has been compromised and is not secure. Please choose a different password.',
            'confirm_password.required' => 'The confirm password field is required.',
            'confirm_password.same' => 'The passwords do not match.',
        ]);

        $representative = new Representative();
        $representative->name = $request->name;
        $representative->email = $request->email;
        $representative->password = Hash::make($request->password);
        $representative->save();

        return redirect()->route('representative.login')->with('success', 'Registration successful!');
    }


    public function cso()
    {
        return view('representative.csoList');
    }
}
