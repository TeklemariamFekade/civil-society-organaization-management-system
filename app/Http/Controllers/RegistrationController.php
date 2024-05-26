<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use App\Models\CSO;
use Carbon\Carbon;
use App\Models\Notification;

class RegistrationController extends Controller
{
    //
    public function foreignRule()
    {
        return view('registration.foreignrule');
    }

    public function localRule()
    {
        return view('registration.localrule');
    }
    public function registrationform()
    {
        return view('registration.registrationform');
    }

    public function viewRegistrationRequest()
    {

        $csos = CSO::has('registration')->get();

        return view('registration.index', compact('csos'));
    }

    public function evaluateRegistration($id)
    {
        $task = Task::findOrFail($id);
        if ($task->status === 'not start') {
            $task->status = 'On Progress';
            $task->save();
        }
        $registration = Registration::findOrFail($task->registration_id);
        $cso = CSO::findOrFail($registration->cso_id);
        if ($cso->status === 'apply') {
            // Update the status of the CSO record to 'pending'
            $cso->status = 'pending';
            $cso->save();
        }
        $address = $cso->address;
        $registration = $cso->registration;

        return view('registration.evaluateRegistration', compact('cso', 'address', 'registration'));
    }

    public function approveRegistration($id)
    {
        $loggedInUser = Auth::id();
        $cso = CSO::findOrFail($id);
        $cso->current_status = true;
        $cso->status  = 'approved';
        $cso->approvalNumber = CSO::generateApprovalNumber();
        $cso->save();

        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->sender =  Auth::user()->name . ', ' . ' ACSO Expert';
        $notification->title = 'Registration Approval Announcement';
        $notification->notification_detail = 'Your  registration Request requested in date is successfully approved by Authority for civil society organization in' . ' ' . $notification->send_date . '. ' . 'Your organization approval number is ' . $cso->approvalNumber . '.';
        // Store the supervisor user IDs as a comma-separated string
        $notification->cso_id = $cso->id;
        $notification->save();



        $supervisorUsers = User::where('role', 'supervisor')->get();
        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->sender =  Auth::user()->name . ', ' . 'Expert';
        $notification->title = 'Task completed Announcement';
        $notification->notification_detail = 'The registration approval task requested from ' . ' ' . $cso->english_name . ' ' . ' is completed successfully' . 'in' . ' ' .  $notification->send_date;
        // Store the supervisor user IDs as a comma-separated string
        $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
        $notification->save();
        $task = Task::find($id);
        if ($task) {
            $task->status = 'completed';
            $task->save();
        }



        return redirect()->back()->with('success', 'approve successfully!');
    }

    public function giveRegistrationFedBack(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'notification_detail' => 'required',
        ]);
        $cso = CSO::findOrFail($id);
        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->sender =  Auth::user()->name . ' ,' . ' ACSO Expert';
        $notification->title =  $request->input('title');
        $notification->notification_detail =  $request->input('notification_detail');
        // Store the supervisor user IDs as a comma-separated string
        $notification->cso_id = $cso->id;
        $notification->save();

        $supervisorUsers = User::where('role', 'supervisor')->get();
        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->sender =  Auth::user()->name . ' ,' . 'Expert';
        $notification->title = 'Task completed Announcement';
        $notification->notification_detail = 'The registration approval task requested from ' . ' ' . $cso->english_name . ' ' . ' is not complete and I give the following feadback' . ' ' . ' ' .  $request->input('notification_detail');
        // Store the supervisor user IDs as a comma-separated string
        $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
        $notification->save();
        $task = Task::find($id);
        if ($task) {
            $task->status = 'completed';
            $task->save();
        }
        return redirect()->back()->with('success', 'feadback sent  successfully!');
    }
}
