<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sector;


use Illuminate\Http\Request;

class SectorController extends Controller
{
    //
    public function viewSector()
    {
        $latestUpdatedSectors = Sector::latest()->first();
        $sectors = Sector::all();
        return view("dataencoder.Sector.index", compact("sectors"));
    }
    public function addSector(Request $request)
    {
        $sector = new Sector();
        $request->validate([
            'sector_name' => 'required',
            'sub_sector_name' => 'required',
        ]);
        $sector->sector_name = $request->sector_name;
        $sector->sub_sector_name = $request->sub_sector_name;
        $sector->save();

        return redirect()->back()->with('success', 'sector is added succussfully');
    }

    public function updateSector(Request $request, Sector $sector)
    {
        $sector = new Sector();
        $request->validate([
            'sector_name' => 'required',
            'sub_sector_name' => 'required',
        ]);
        $sectorId = $request->input('id');
        $sector = Sector::findOrFail($sectorId);
        // Update the user information
        $sector->sector_name = $request->sector_name;
        $sector->sub_sector_name = $request->sub_sector_name;
        $sector->save();
        // Redirect back with a success message
        return redirect()->back()->with('status', 'Sector is  updated successfully.');
    }
}
