<?php

namespace App\Http\Controllers;

use App\Models\CSO;
use App\Models\AddressChange;
use App\Models\NameChange;
use App\Models\Support_Letter;
use App\Models\Service;
use Carbon\Carbon;

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

        return redirect()->back()->with('success', 'Address Change request submitted successfully.');
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
        $notification = new Notification();
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
        return redirect()->back()->with('success', 'Name Change request submitted successfully.');
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
        $notification = new Notification();
        $cso = CSO::where([
            ['english_name', '=', $request->input('app_english_name')],
            ['amharic_name', '=', $request->input('app_amharic_name')],
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
        return redirect()->back()->with('success', 'support letter request submitted successfully.');
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
        $meetingLetter = new Support_Letter();
        $notification = new Notification();
        $cso = CSO::where([
            ['english_name', '=', $request->input('app_english_name')],
            ['amharic_name', '=', $request->input('app_amharic_name')],
        ])->first();
        $service = Service::where('service_name', 'support letter request')->first();
        $cso_file = $request->file('cso_file');
        $filename = time() . '.' . $cso_file->getClientOriginalExtension();
        $cso_file->move('storage', $filename);
        $meetingLetter->cso_file = $filename;
        $meetingLetter->send_date = Carbon::now();

        if ($cso) {
            $meetingLetter->cso_id = $cso->id;
        }
        if ($service) {
            $meetingLetter->service_id = $service->id;
        }

        return redirect()->back()->with('success', 'support letter request submitted successfully.');
    }
}
