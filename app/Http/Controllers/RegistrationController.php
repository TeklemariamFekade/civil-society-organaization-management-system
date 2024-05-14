<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Task;
use App\Models\CSO;

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

    public function evaluate($id)
    {

        $task = Task::find($id);
        if ($task) {
            $task->status = 'On Progress';
            $task->save();
        }
        $registration = Registration::findOrFail($id);

        return view('registration.approval', compact('registration'));
    }
}
