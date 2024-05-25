<?php

namespace App\Http\Controllers;

use App\Models\CSO;
use App\Models\NameChange;
use App\Models\Support_Letter;
use App\Models\Service;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AddressChange;
use App\Models\Task;
use Exception;
use App\Models\Notification;

use Illuminate\Http\Request;

class ServiceController extends Controller
{

    // index for service
    public function  viewService()
    {
        return view('service.index');
    }


    //address chang rule
    public function addressChangeRule()
    {
        return view('service.addressChange');
    }
    //address change form
    public function addressChangeForm()
    {
        return view('service.addressChangeForm');
    }

    //fill address change form
    public function fillAddressChangeForm(Request $request)
    {
        $request->validate([
            'app_english_name' => 'required|string',
            'app_amharic_name' => 'required|string',
            'category' => 'required|string',
            'place_of_work' => 'required|string',
            'country' => 'required|string',
            'region' => 'required|string',
            'zone' => 'required|string',
            'woreda' => 'required|string',
            'kebele' => 'required|string',
            'district' => 'required|string',
            'phone_no' => 'required|string',
            'po_box' => 'required|string',
            'email' => 'required|email',
            'cso_file' => 'required|file',
        ]);

        $cso = CSO::where([
            ['english_name', $request->input('app_english_name')],
            ['amharic_name', $request->input('app_amharic_name')],
            ['category', $request->input('category')]
        ])->first();
        $service = Service::where('service_name', 'address change request')->first();

        $addressChange = new AddressChange();
        $notification = new Notification();
        $addressChange->place_of_work = $request->input('place_of_work');
        $addressChange->country = $request->input('country');
        $addressChange->region = $request->input('region');
        $addressChange->zone = $request->input('zone');
        $addressChange->woreda = $request->input('woreda');
        $addressChange->kebele = $request->input('kebele');
        $addressChange->district = $request->input('district');
        $addressChange->phone_no = $request->input('phone_no');
        $addressChange->po_box = $request->input('po_box');
        $addressChange->email = $request->input('email');
        $cso_file = $request->file('cso_file');
        $filename = time() . '.' . $cso_file->getClientOriginalExtension();
        $cso_file->move('storage', $filename);
        $addressChange->cso_file = $filename;

        if ($cso) {
            $addressChange->cso_id = $cso->id;
        }

        if ($service) {
            $addressChange->service_id = $service->id;
        }
        $addressChange->send_date = Carbon::now();
        $addressChange->save();

        // send notification to supervisor
        $supervisorUsers = User::where('role', 'supervisor')->get();
        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->title = 'Address  Change Requests';
        $notification->notification_detail = 'New civil society Address change request is requested from' . ' ' . $cso->english_name . ' ' . ' in' . ' ' . $addressChange->send_date;
        // Store the supervisor user IDs as a comma-separated string
        $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
        $notification->save();

        return redirect()->back()->with('success', 'Address Change request submitted successfully.');
    }

    public function viewAddressChangeRequest()
    {

        $csos = Cso::has('addresschange')->get();

        return view('service.address_change.addressChangeRequests', compact('csos'));
    }
    public function evaluateAddressChangeRequest($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = 'On Progress';
            $task->save();
        }
        $cso = CSO::findOrFail($id);

        // Retrieve the related Address and Registration records
        $address = $cso->address;
        $addresschanges = $cso->addresschange;

        return view('service.address_change.evaluateAddressChangeRequest', compact('cso', 'address', 'addresschanges'));
    }
    public function approveAddressChange($id)
    {
        $cso = CSO::findOrFail($id);
        $address = $cso->address;

        // Access the addresschange relationship as a query
        $addressChange = $cso->addresschange()->latest()->first();

        // Check if the necessary properties exist on the $addressChange model
        if ($addressChange) {
            $address->place_of_work = $addressChange->place_of_work;
            $address->country = $addressChange->country;
            $address->region = $addressChange->region;
            $address->zone = $addressChange->zone;
            $address->woreda = $addressChange->woreda;
            $address->kebele = $addressChange->kebele;
            $address->district = $addressChange->district;
            $address->phone_no = $addressChange->phone_no;
            $address->po_box = $addressChange->po_box;
            $address->email = $addressChange->email;
            $address->save();


            $notification = new Notification();
            $notification->send_date = Carbon::now();
            $notification->title = 'Address Change Approval Announcement';
            $notification->notification_detail = 'Your  Address Change Request requested in date is successfully approved by Authority for civil society organization in' . ' ' . $notification->send_date . '.';
            // Store the supervisor user IDs as a comma-separated string
            $notification->cso_id = $cso->id;
            $notification->save();


            $supervisorUsers = User::where('role', 'supervisor')->get();
            $notification = new Notification();
            $notification->send_date = Carbon::now();
            $notification->title = 'Task completed Announcement';
            $notification->notification_detail = ' An Address change request task requested from ' . $cso->english_name . ' is completed successfully' . ' ' . 'in ' . ' ' . $notification->send_date;
            // Store the supervisor user IDs as a comma-separated string
            $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
            $notification->save();
            $task = Task::find($id);
            if ($task) {
                $task->status = 'completed';
                $task->save();
            }

            return redirect()->back()->with('success', 'Address Change approved submitted successfully.');
        }


        // Handle the case where there is no address change record
        return redirect()->back()->with('error', 'No address change record found for the given CSO.');
    }



    public function rejectAddressChange()
    {
    }






    // Name change rule
    public function nameChangeRule()
    {
        return view('service.nameChange');
    }
    //name change form
    public function viewNameChangeForm()
    {
        return view('service.nameChangeForm');
    }

    //fill name change form
    public function fillNameChangeForm(Request $request)
    {
        $request->validate([
            'old_english_name' => 'required|string',
            'old_amharic_name' => 'required|string',
            'new_english_name' => 'required|string',
            'new_amharic_name' => 'required|string',
            'cso_file' => 'required|file',
        ]);

        $nameChange = new NameChange();
        $cso = CSO::where([
            ['english_name', $request->input('old_english_name')],
            ['amharic_name', $request->input('old_amharic_name')]
        ])->first();
        $nameChange->new_english_name = $request->input('new_english_name');
        $nameChange->new_amharic_name = $request->input('new_amharic_name');
        $service = Service::where('service_name', 'name change request')->first();
        $cso_file = $request->file('cso_file');
        $filename = time() . '.' . $cso_file->getClientOriginalExtension();
        $cso_file->move('storage', $filename);
        $nameChange->cso_file = $filename;
        $nameChange->send_date = Carbon::now();
        if ($cso) {
            $nameChange->cso_id = $cso->id;
        }

        if ($service) {
            $nameChange->service_id = $service->id;
        }
        $nameChange->save();

        $supervisorUsers = User::where('role', 'supervisor')->get();
        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->title = 'Name Change Requests';
        $notification->notification_detail = 'New civil society name change request is requested from' . ' ' . $cso->english_name . ' in' . ' ' . $nameChange->send_date;
        // Store the supervisor user IDs as a comma-separated string
        $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
        $notification->save();
        return redirect()->back()->with('success', 'Name Change request submitted successfully.');
    }
    public function viewNameChangeRequest()
    {

        $csos = CSO::has('nameChange')->get();

        return view('service.name_change.nameChangeRequests', compact('csos'));
    }
    public function evaluateNameChangeRequest($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = 'On Progress';
            $task->save();
        }

        $cso = CSO::findOrFail($id);

        // Retrieve the related Address and Registration records
        $nameChange = $cso->nameChange;

        return view('service.name_change.evaluateNameChangeRequests', compact('cso', 'nameChange'));
    }
    public function approveNameChange($id)
    {
        $cso = CSO::findOrFail($id);
        $nameChange = $cso->nameChange()->latest()->first(); // Get the most recent name change

        if ($nameChange) {
            $cso->english_name = $nameChange->new_english_name;
            $cso->amharic_name = $nameChange->new_amharic_name;
            $cso->save();

            $notification = new Notification();
            $notification->send_date = Carbon::now();
            $notification->title = 'Name Change Approval Announcement';
            $notification->notification_detail = 'Your  organization Name Change Request requested in date is successfully approved by Authority for civil society organization in' . ' ' . $notification->send_date . '.';
            // Store the supervisor user IDs as a comma-separated string
            $notification->cso_id = $cso->id;
            $notification->save();


            $supervisorUsers = User::where('role', 'supervisor')->get();
            $notification = new Notification();
            $notification->send_date = Carbon::now();
            $notification->title = 'Task completed Announcement';
            $notification->notification_detail = 'Organization Name change request task requested from ' . ' ' . $cso->english_name . ' is completed successfully' . 'in' . ' ' . $notification->send_date;
            // Store the supervisor user IDs as a comma-separated string
            $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
            $notification->save();
            $task = Task::find($id);
            if ($task) {
                $task->status = 'completed';
                $task->save();
            }

            return redirect()->back()->with('success', 'Successful');
        } else {
            // Handle the case where there is no name change record
            throw new Exception("No name change record found for the given CSO.");
        }
    }


    public function rejectNameChange()
    {
    }




    //support letter logo rule
    public function support_letter_logo_rule()
    {
        return view('service.logo_letter');
    }
    //support letter logo form
    public function support_letter_logo_form()
    {
        return view('service.logo_letter_form');
    }



    //fill form
    public function fill_support_letter_logo_form(Request $request)
    {
        $request->validate([
            'app_english_name' => 'required|string',
            'app_amharic_name' => 'required|string',
            'cso_file' => 'required|file',
        ]);
        $logoLetter = new Support_Letter();
        $cso = CSO::where([
            ['english_name', '=', $request->input('app_english_name')],
            ['amharic_name', '=', $request->input('app_amharic_name')]
        ])->first();
        $service = Service::where('service_name', 'support letter request')->first();
        $cso_file = $request->file('cso_file');
        $filename = time() . '.' . $cso_file->getClientOriginalExtension();
        $cso_file->move('storage', $filename);
        $logoLetter->cso_file = $filename;
        $logoLetter->send_date = Carbon::now();

        if ($cso) {
            $logoLetter->cso_id = $cso->id;
        }

        if ($service) {
            $logoLetter->service_id = $service->id;
        }

        $logoLetter->save();
        // send notification to supervisor
        $supervisorUsers = User::where('role', 'supervisor')->get();
        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->title = 'Logo Change Requests';
        $notification->notification_detail = 'New civil society logo change request is requested from' . ' ' . $cso->english_name . ' in' . ' ' .  $logoLetter->send_date;
        // Store the supervisor user IDs as a comma-separated string
        $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
        $notification->save();

        return redirect()->back()->with('success', 'support letter request submitted successfully.');
    }

    public function viewLetterRequest()
    {

        $csos = CSO::has('supportLetters')->get();

        return view('service.letter.letterRequests', compact('csos'));
    }

    //support letter for meeting rule
    public function support_letter_meeting_rule()
    {
        return view('service.meeting_letter');
    }
    // support letter meeting form
    public function support_letter_meeting_form()
    {
        return view('service.meeting_letter_form');
    }

    // fill form
    public function fill_support_letter_meeting_form(Request $request)
    {
        $request->validate([
            'app_english_name' => 'required|string',
            'app_amharic_name' => 'required|string',
            'cso_file' => 'required|file',
        ]);

        $cso = CSO::where([
            ['english_name', '=', $request->input('app_english_name')],
            ['amharic_name', '=', $request->input('app_amharic_name')]
        ])->first();

        if (!$cso) {
            // Handle case where CSO is not found
            return redirect()->back()->with('error', 'CSO not found.');
        }

        $service = Service::where('service_name', 'support letter request')->first();

        $meetingLetter = new Support_Letter();
        $meetingLetter->send_date = Carbon::now();
        $meetingLetter->cso_id = $cso->id;
        $meetingLetter->service_id = $service ? $service->id : null;

        $cso_file = $request->file('cso_file');
        $filename = time() . '.' . $cso_file->getClientOriginalExtension();
        $cso_file->move('storage', $filename);
        $meetingLetter->cso_file = $filename;
        $meetingLetter->save();

        $supervisorUsers = User::where('role', 'supervisor')->get();
        $notification = new Notification();
        $notification->send_date = Carbon::now();
        $notification->title = 'Meeting invitation letter Requests';
        $notification->notification_detail = ' Civil society Meeting invitation letter Request is requested from' . ' ' . $cso->english_name . ' in' . ' ' . $meetingLetter->send_date->send_date;
        // Store the supervisor user IDs as a comma-separated string
        $notification->user_id = implode(',', $supervisorUsers->pluck('id')->toArray());
        $notification->save();
        return redirect()->back()->with('success', 'Support letter request submitted successfully.');
    }

    public function evaluateSupportLetterRequest($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = 'On Progress';
            $task->save();
        }

        // Retrieve the CSO record by ID
        $cso = CSO::findOrFail($id);

        // Retrieve the related Address and Registration records
        $supportLetters = $cso->supportLetters;

        return view('service.letter.evaluateLetterRequests', compact('cso', 'supportLetters'));
    }

    public function replySupportLetter()
    {
    }

    // evaluate

}
