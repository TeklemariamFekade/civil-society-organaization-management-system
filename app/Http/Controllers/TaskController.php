<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    public function index()
    {
        $latestUpdatedUser = User::latest()->first();
        $users = User::all();
        return view('admin.user', compact('users', 'latestUpdatedUser'));
    }

    public function viewTask()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $tasks = Task::where('user_id', $loggedInUserId)->get();

        return view("Task.index", compact("tasks"));
    }

    public function assign(Request $request, $id)
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
        return redirect()->route('registration.index')->with('success', 'Task assigned successfully!');
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
