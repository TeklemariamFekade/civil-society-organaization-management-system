<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;

class ExpertController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:expert');
    }
    public function showDashboard()
    {

        $completeTask = Task::where('status', 'completed')->whereNotNull('registration_id')->count();
        $onprogressTask = Task::where('status', 'on Progress')->whereNotNull('registration_id')->count();
        $notStartTask = Task::where('status', 'not Start')->whereNotNull('registration_id')->count();
        $totalTask = Task::where('status', '')->count();
        $totalTask = $completeTask + $onprogressTask + $notStartTask;
        $data = [
            'labels' => ['complete task', 'progress task', 'not start task'],
            'datasets' => [
                [
                    'label' => 'Task',
                    'data' => [$completeTask, $onprogressTask, $notStartTask, $totalTask],
                ],
            ],
        ];
        return view('expert.dashboard', compact('notStartTask', 'totalTask', 'onprogressTask', 'completeTask', 'data'));
    }
    public function  viewProfile()
    {
        return view('expert.profile');
    }

    public function changePassword()
    {
        return view('expert.changePassword');
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
            $user->photo = $request->file('photo')->store('public/photos');
        }


        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
