<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Task;
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

    public function rejectRequest()
    {
    }

    public function approve(Request $request, $id)
    {
    }

    public function evaluateRegistration($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = 'On Progress';
            $task->save();
        }

        // Retrieve the CSO record by ID
        $cso = CSO::findOrFail($id);
        if ($cso->status === 'apply') {
            // Update the status of the CSO record to 'pending'
            $cso->status = 'pending';
            $cso->save();
        }
        // Retrieve the related Address and Registration records
        $address = $cso->address;
        $registration = $cso->registration;

        return view('registration.evaluateRegistration', compact('cso', 'address', 'registration'));
    }

    public function approveRegistration($id)
    {
        $cso = CSO::findOrFail($id);
        $cso->current_status = true;
        $cso->status  = 'approved';
        $cso->approvalNumber = CSO::generateApprovalNumber();
        $cso->save();


        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->title = 'Registration Requests';
        $notification->notification_detail = 'New registration Request is requested ';
        // Store the supervisor user IDs as a comma-separated string
        $notification->cso_id = $cso->id;
        $notification->save();

        return redirect()->back()->with('success', 'approve successfully!');
    }

    public function rejectRegistration()
    {
    }
}
