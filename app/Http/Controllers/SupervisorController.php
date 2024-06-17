<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CSO;
use App\Models\Namechange;
use App\Models\AddressChange;
use App\Models\Service;
use App\Models\Support_Letter;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:supervisor');
    }

    public function showDashboard()
    {
        $csoRequest = CSO::where('status', 'apply')->count();
        $letterRequest = Support_letter::where('status', 0)->count();
        $addressChangeRequest = AddressChange::where('status', 0)->count();
        $nameChangeRequest = NameChange::where('status', 0)->count();
        $totalRequest = $csoRequest +  $letterRequest +  $addressChangeRequest + $nameChangeRequest;
        $data = [
            'labels' => ['registration Requests', 'Support Letter Requests', 'Address Change Requests', 'Name Change Request'],
            'datasets' => [
                [
                    'label' => 'Requests',
                    'data' => [$csoRequest, $letterRequest, $addressChangeRequest, $nameChangeRequest],
                ],
            ],
        ];

        return view('supervisor.dashboard', compact('totalRequest', 'letterRequest', 'csoRequest', 'addressChangeRequest', 'data'));
    }

    public function viewProfile()
    {
        return view('supervisor.profile');
    }

    public function changePassword()
    {
        return view('supervisor.changePassword');
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

            // Verify the current password

            // Update the password
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

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
