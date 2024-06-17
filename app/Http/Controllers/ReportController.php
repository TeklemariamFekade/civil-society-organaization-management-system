<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CSO;
use Illuminate\Support\Facades\DB; // Import DB facade
use ConsoleTVs\Charts\Facades\Charts;
use App\Models\Sector;
use App\Models\Support_Letter;
use App\Models\AddressChange;
use App\Models\NameChange;

class ReportController extends Controller
{
    public function index()
    {
        return view("Report.dataEncoder.index");
    }

    public function viewsector()
    {
        // Your logic for viewing sectors
    }
    public function generateReportBySector()
    {
        $csoData = CSO::with('sector')
            ->select('sector_id', DB::raw('count(*) as total'))
            ->groupBy('sector_id')
            ->get();

        $chartLabels = $csoData->pluck('sector.sector_name')->toArray();
        $chartData = $csoData->pluck('total')->toArray();

        return view('Report.dataEncoder.sectorReport', compact('csoData', 'chartLabels', 'chartData'));
    }
    public function generateReportByCategory($category = null, $type = null)
    {

        $csos = Cso::query();

        if ($category) {
            $csos->where('category', $category);
        }

        if ($type) {
            $csos->where('type', $type);
        }

        $csos = $csos->get();

        $categories = Cso::pluck('category')->unique();
        $types = Cso::pluck('type')->unique();

        return view('Report.dataEncoder.csoReport', compact('csos', 'categories', 'types'));
    }


    public function downloadReport(Request $request)
    {
        $query = \App\Models\CSO::query();

        if ($request->has('category') && $request->input('category') !== '') {
            $query->where('category', $request->input('category'));
        }

        if ($request->has('type') && $request->input('type') !== '') {
            $query->where('type', $request->input('type'));
        }

        $csos = $query->get();

        $fileName = 'cso_report.csv';
        $headers = ['English Name', 'Amharic Name', 'Category', 'Type'];

        $callback = function () use ($csos, $headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            foreach ($csos as $cso) {
                fputcsv($file, [
                    $cso->english_name,
                    $cso->amharic_name,
                    $cso->category,
                    $cso->type
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }



    public function generateTaskReport($category = null, $type = null)
    {

        $csos = Cso::query();


        $csos = $csos->get();

        $categories = Cso::pluck('category')->unique();
        $types = Cso::pluck('type')->unique();
        $status = Cso::pluck('status')->unique();

        return view('Report.dataEncoder.taskReport', compact('csos', 'categories', 'types', 'status'));
    }


    public function downloadTaskReport(Request $request)
    {

        $query = \App\Models\CSO::query();
        $csos = $query->get();
        $fileName = 'cso_report.csv';
        $headers = ['English Name', 'Amharic Name', 'Category', 'Type', 'status'];

        $callback = function () use ($csos, $headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            foreach ($csos as $cso) {
                fputcsv($file, [
                    $cso->english_name,
                    $cso->amharic_name,
                    $cso->category,
                    $cso->type,
                    $cso->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}
