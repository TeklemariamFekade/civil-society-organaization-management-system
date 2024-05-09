<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Registration;
use App\Models\CSO;
use App\Models\Address;
use App\Models\Sector;

class CSOController extends Controller
{
    public function request(Request $request)
    {
        $request->validate([
            'english_name' => 'required|string',
            'amharic_name' => 'required|string',
            'date_of_established' => 'required|date',
            'type' => 'required|string',
            'category' => 'required|string',
            'sector_name' => 'required|string',
            'sub_sector_name' => 'required|string',
            'place_of_work' => 'required|string',
            'country_of_origin' => 'required|string',
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

        $sector = Sector::firstOrCreate([
            'sector_name' => $request->input('sector_name'),
            'sub_sector_name' => $request->input('sub_sector_name'),
        ]);

        $cso = new CSO();
        $cso->english_name = $request->input('english_name');
        $cso->amharic_name = $request->input('amharic_name');
        $cso->date_of_established = $request->input('date_of_established');
        $cso->type = $request->input('type');
        $cso->category = $request->input('category');
        $cso->representative_id = Auth::guard('representative')->id();
        $cso_file = $request->file('cso_file');
        $filename = time() . '.' . $cso_file->getClientOriginalExtension();
        $cso_file->move('storage', $filename);
        $cso->cso_file = $filename;
        $cso->sector_id = $sector->id; // Assign the sector_id
        $cso->save();


        $address = new Address();
        $address->place_of_work = $request->input('place_of_work');
        $address->country_of_origin = $request->input('country_of_origin');
        $address->country = $request->input('country');
        $address->region = $request->input('region');
        $address->zone = $request->input('zone');
        $address->woreda = $request->input('woreda');
        $address->kebele = $request->input('kebele');
        $address->district = $request->input('district');
        $address->phone_no = $request->input('phone_no');
        $address->po_box = $request->input('po_box');
        $address->email = $request->input('email');
        $address->cso_id = $cso->id;
        $address->save();

        $registration = new Registration();
        $registration->cso_id = $cso->id;
        $registration->send_date = Carbon::now();
        $registration->save();

        return redirect()->route('registration.registrationform')->with('success', 'Registration submitted successfully.');
    }


    // public function show()
    // {
    //     // Logic for showing data
    // }
}
