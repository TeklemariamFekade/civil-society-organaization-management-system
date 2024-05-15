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

class TaskController extends Controller
{
    //
    public function index()
    {
        $latestUpdatedUser = User::latest()->first();
        $users = User::all();
        return view('admin.user', compact('users', 'latestUpdatedUser'));
    }



    //To View tasks in expert or data encoder side
    public function viewDataEncoderTask()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $tasks = Task::where('user_id', $loggedInUserId)->get();

        return view("Task.dataEncoder.index", compact("tasks"));
    }

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

        $task = new Task();
        $task->task_name = $request->input('task_name');
        $task->due_date = $request->input('due_date');
        $assignedUser = User::where('name', $request->input('user_name'))->first();
        $registration = Registration::findOrFail($id);

        if ($assignedUser && $registration) {
            $task->user_id = $assignedUser->id;
            $task->registration_id = $registration->id;
        } else {
            // Handle the case when the user or registration is not found
            // You can throw an exception, return an error response, or handle it as per your application's requirements
        }
        $task->save();
        return redirect()->route('service.name_change.viewNameChangeRequest')->with('success', 'Task assigned successfully!');
    }
    // To Assign  name change request Tasks for data encoder
    public function assignNameChangeTask(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'due_date' => 'required',
            'user_name' => 'required',
        ]);

        $task = new Task();
        $task->task_name = $request->input('task_name');
        $task->due_date = $request->input('due_date');
        $assignedUser = User::where('name', $request->input('user_name'))->first();
        $nameChange = NameChange::findOrFail($id);

        if ($assignedUser && $nameChange) {
            $task->user_id = $assignedUser->id;
            $task->name_changes_id = $nameChange->id;
        } else {
            // Handle the case when the user or registration is not found
            // You can throw an exception, return an error response, or handle it as per your application's requirements
        }
        $task->save();
        return redirect()->route('registration.index')->with('success', 'Task assigned successfully!');
    }

    public function assignSupportLetterTask(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'due_date' => 'required',
            'user_name' => 'required',
        ]);

        $task = new Task();
        $task->task_name = $request->input('task_name');
        $task->due_date = $request->input('due_date');
        $assignedUser = User::where('name', $request->input('user_name'))->first();
        $supportLetter = Support_Letter::findOrFail($id);

        if ($assignedUser && $supportLetter) {
            $task->user_id = $assignedUser->id;
            $task->support_letter_id = $supportLetter->id;
        } else {
            // Handle the case when the user or registration is not found
            // You can throw an exception, return an error response, or handle it as per your application's requirements
        }
        $task->save();
        return redirect()->route('service.letter.viewLetterRequest')->with('success', 'Task assigned successfully!');
    }
    // To assign address change Requests  for data encoder

    public function assignAddressChangeTask(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required',
            'due_date' => 'required',
            'user_name' => 'required',
        ]);

        $task = new Task();
        $task->task_name = $request->input('task_name');
        $task->due_date = $request->input('due_date');
        $assignedUser = User::where('name', $request->input('user_name'))->first();
        $addressChange = AddressChange::findOrFail($id);

        if ($assignedUser && $addressChange) {
            $task->user_id = $assignedUser->id;
            $task->address_changes_id = $addressChange->id;
        } else {
            // Handle the case when the user or registration is not found
            // You can throw an exception, return an error response, or handle it as per your application's requirements
        }
        $task->save();
        return redirect()->route('service.address_change.viewAddressChangeRequest')->with('success', 'Task assigned successfully!');
    }








    public function UpdateStatus($id)
    {

        $task = Task::find($id);
        if ($task) {
            $task->status = 'On Progress';
            $task->save();
        }
        return redirect()->back();
    }
}
