<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use App\Models\NameChange;
use App\Models\AddressChange;
use App\Models\Support_Letter;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\CSO;
use exception;

class TaskController extends Controller
{
    //
    //To View tasks in expert or data encoder side
    public function viewLetterTask()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $tasks = Task::where('user_id', $loggedInUserId)
            ->whereNotNull('support_letter_id')->get();

        return view("Task.dataEncoder.letterIndex", compact("tasks"));
    }

    public function viewNameChangeTask()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $tasks = Task::where('user_id', $loggedInUserId)
            ->whereNotNull('name_changes_id')->get();

        return view("Task.dataEncoder.nameChangeIndex", compact("tasks"));
    }

    public function viewAddressChangeTask()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $tasks = Task::where('user_id', $loggedInUserId)
            ->whereNotNull('address_changes_id')
            ->get();

        return view("Task.dataEncoder.addressChangeIndex", compact("tasks"));
    }

    // View Expert Tasks
    public function viewExpertTask()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $tasks = Task::where('user_id', $loggedInUserId)->get();

        return view("Task.expert.index", compact("tasks"));
    }




    //   To assign Registration Tasks for expert
    public function assignRegistrationTask(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'due_date' => 'required',
            'user_name' => 'required',
        ]);


        $registration = Registration::findOrFail($id);

        $existingTask = Task::where('registration_id',   $registration->id)->first();

        if ($existingTask) {
            // A task is already assigned for the given address_change_id
            return redirect()->route('registration.index.viewRegistrationRequest')
                ->withErrors(['error' => 'A task is already assigned. ']);
        } else {

            $task = new Task();
            $task->task_name = $request->input('task_name');
            $task->due_date = $request->input('due_date');
            $assignedUser = User::where('name', $request->input('user_name'))->first();
            if ($assignedUser && $registration) {
                $task->user_id = $assignedUser->id;
                $task->registration_id = $registration->id;
            } else {
                // Handle the case when the user or registration is not found
                // You can throw an exception, return an error response, or handle it as per your application's requirements
            }
            $task->save();


            if ($registration->status == 0) {
                $registration->status = 1;
                $registration->save();
            }
            $cso = CSO::where('id', $registration->cso_id)->first(); // Use 'first' instead of 'get'
            if ($cso) {

                $notification = new Notification();
                $notification->send_date = Carbon::now();
                $notification->sender =  Auth::user()->name . ' ,' . 'Supervisor';
                $notification->title = 'Registration Approval Process Started';
                $notification->notification_detail = 'Your  registration Request requested in date is on process . Authority for civil society organization  announce the result recently ';
                // Store the supervisor user IDs as a comma-separated string
                $notification->cso_id = $cso->id;
                $notification->save();
            } else {
                // Handle the case where no record was found
                // For example, throw an exception or return an error response
                throw new Exception("CSO record not found");
            }

            $notification = new Notification();
            $notification->send_date = Carbon::now();
            $notification->sender =  Auth::user()->name . ' ,' . 'Supervisor';
            $notification->title = 'Registration Requests tasks';
            $notification->notification_detail = 'new registration Request task is assigned for you. The due date of the task is ' . $task->due_date;   // Store the supervisor user IDs as a comma-separated string
            $notification->user_id = $assignedUser->id;
            $notification->save();
            return redirect()->route('registration.index.viewRegistrationRequest')->with('success', 'Task assigned successfully!');
        }
    }


    // To Assign  name change request Tasks for data encoder
    public function assignNameChangeTask(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'due_date' => 'required',
            'user_name' => 'required',
        ]);

        $nameChange = NameChange::findOrFail($id);

        $existingTask = Task::where('name_changes_id',   $nameChange->id)->first();


        if ($existingTask) {
            // A task is already assigned for the given address_change_id
            return redirect()->route('service.name_change.viewNameChangeRequest')
                ->withErrors(['error' => 'A task is already assigned. ']);
        } else {
            $task = new Task();
            $task->task_name = $request->input('task_name');
            $task->due_date = $request->input('due_date');
            $assignedUser = User::where('name', $request->input('user_name'))->first();


            if ($assignedUser && $nameChange) {
                $task->user_id = $assignedUser->id;
                $task->name_changes_id = $nameChange->id;
            } else {
                // Handle the case when the user or registration is not found
                // You can throw an exception, return an error response, or handle it as per your application's requirements
            }
            $task->save();

            if ($nameChange->status == 0) {
                $nameChange->status = 1;
                $nameChange->save();
            }
            $cso = CSO::where('id', $nameChange->cso_id)->first(); // Use 'first' instead of 'get'
            if ($cso) {
                $notification = new Notification();
                $notification->send_date = Carbon::now();
                $notification->sender =  Auth::user()->name . ' ,' . 'ACSO Supervisor';
                $notification->title = 'OrganizatIon Name Change Approval Process Started';
                $notification->notification_detail = 'Your OrganizatIon Name Change  Request requested in date is on process . Authority for civil society organization  announce the result recently ';
                // Store the supervisor user IDs as a comma-separated string
                $notification->cso_id = $cso->id;
                $notification->save();
            } else {
                // Handle the case where no record was found
                // For example, throw an exception or return an error response
                throw new Exception("CSO record not found");
            }


            $notification = new Notification();
            $notification->send_date = Carbon::now();
            $notification->sender =  Auth::user()->name . ', ' . 'Supervisor';
            $notification->title = 'Organization Name Change Request Tasks';
            $notification->notification_detail = 'New Organization Name Change Request Task is assigned for you. The due date of the task is ' . $task->due_date;   // Store the supervisor user IDs as a comma-separated string
            // Store the supervisor user IDs as a comma-separated string
            $notification->user_id = $assignedUser->id;
            $notification->save();

            return redirect()->route('service.name_change.viewNameChangeRequest')->with('success', 'Task assigned successfully!');
        }
    }

    //Assign support letter request task for data encoder

    public function assignSupportLetterTask(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'due_date' => 'required',
            'user_name' => 'required',
        ]);

        $supportLetter = Support_Letter::findOrFail($id);
        $existingTask = Task::where('support_letter_id',  $supportLetter->id)->first();
        if ($existingTask) {
            // A task is already assigned for the given address_change_id
            return redirect()->route('service.letter.viewLetterRequest')
                ->withErrors(['error' => 'A task is already assigned.']);
        } else {
            $task = new Task();
            $task->task_name = $request->input('task_name');
            $task->due_date = $request->input('due_date');
            $assignedUser = User::where('name', $request->input('user_name'))->first();

            if ($assignedUser && $supportLetter) {
                $task->user_id = $assignedUser->id;
                $task->support_letter_id = $supportLetter->id;
            } else {
                // Handle the case when the user or registration is not found
                // You can throw an exception, return an error response, or handle it as per your application's requirements
            }
            $task->save();

            if ($supportLetter->status == 0) {
                $supportLetter->status = 1;
                $supportLetter->save();
            }

            $cso = CSO::where('id', $supportLetter->cso_id)->first(); // Use 'first' instead of 'get'

            if ($cso) {
                $notification = new Notification();
                $notification->send_date = Carbon::now();
                $notification->sender = Auth::user()->name . ' ,' . 'ACSO Supervisor';
                $notification->title = 'Support letter Approval Process Started';
                $notification->notification_detail = 'Your Support letter Request requested in date is on process . Authority for civil society organization  announce the result recently ';
                $notification->cso_id = $cso->id;
                $notification->save();
            } else {
                // Handle the case where no record was found
                // For example, throw an exception or return an error response
                throw new Exception("CSO record not found");
            }
            $notification = new Notification();
            $notification->send_date = Carbon::now();
            $notification->sender = Auth::user()->name . ' ,' . 'Supervisor';
            $notification->title = 'Support Letter Request Tasks';
            $notification->notification_detail = ' Organization Support Letter Request Task is assigned for you. The due date of the task is ' . $task->due_date;   // Store the supervisor user IDs as a comma-separated string
            // Store the supervisor user IDs as a comma-separated string
            $notification->user_id = $assignedUser->id;
            $notification->save();

            return redirect()->route('service.letter.viewLetterRequest')->with('success', 'Task assigned successfully!');
        }
    }


    // To assign address change Requests  for data encoder
    public function assignAddressChangeTask(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'due_date' => 'required',
            'user_name' => 'required',
        ]);

        $addressChange = AddressChange::findOrFail($id);
        $existingTask = Task::where('address_changes_id', $addressChange->id)->first();
        if ($existingTask) {
            // A task is already assigned for the given address_change_id
            return redirect()->route('service.address_change.viewAddressChangeRequest')
                ->withErrors(['error' => 'A task is already assigned .']);
        } else {
            $task = new Task();
            $task->task_name = $request->input('task_name');
            $task->due_date = $request->input('due_date');
            $assignedUser = User::where('name', $request->input('user_name'))->first();

            if ($assignedUser) {
                $task->user_id = $assignedUser->id;
                $task->address_changes_id = $addressChange->id;
                $task->save();

                if ($addressChange->status == 0) {
                    $addressChange->status = 1;
                    $addressChange->save();
                }


                $cso = CSO::where('id', $addressChange->cso_id)->first(); // Use 'first' instead of 'get'

                if ($cso) { // Check if $cso is not null
                    $notification = new Notification();
                    $notification->send_date = Carbon::now();
                    $notification->sender = Auth::user()->name . ' ,' . 'ACSO Supervisor';
                    $notification->title = 'Address Change Approval Process Started';
                    $notification->notification_detail = 'Your Address Change Request requested in date is on process . Authority for civil society organization announce the result recently';
                    $notification->cso_id = $cso->id; // Now you can safely access the id property
                    $notification->save();
                } else {
                    // Handle the case where no record was found
                    // For example, throw an exception or return an error response
                    throw new Exception("CSO record not found");
                }


                $notification = new Notification();
                $notification->send_date = Carbon::now();
                $notification->sender = Auth::user()->name . ' ,' . 'Supervisor';
                $notification->title = 'Organization Address Change Tasks';
                $notification->notification_detail = 'Organization Address Change Task is assigned for you. The due date of the task is ' . $task->due_date;   // Store the supervisor user IDs as a comma-separated string
                // Store the supervisor user IDs as a comma-separated string
                $notification->user_id = $assignedUser->id;
                $notification->save();

                return redirect()->route('service.address_change.viewAddressChangeRequest')
                    ->with('success', 'Task assigned successfully!');
            } else {
                // Handle the case when the user is not found
                // You can throw an exception, return an error response, or handle it as per your application's requirements
            }
        }
    }
}
