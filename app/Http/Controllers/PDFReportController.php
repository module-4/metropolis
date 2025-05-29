<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\LaravelPdf\Facades\Pdf;
class  PDFReportController extends Controller
{
    public function index() {

        $simulation = Simulation::firstOrCreate([], ["alias" => "simulation_1"]);
        $totalEffects = $simulation->getGridEffects();
        $simulationComponents = $simulation->components;

        $dateOfExport = Carbon::now()->toDateString();
        $fileName = 'Simulation Report - ' . $dateOfExport;

        //return view('report', compact('simulation', 'effects', 'simulationComponents', 'dateOfExport'));

        return Pdf::view('report', compact('simulation', 'totalEffects', 'simulationComponents', 'dateOfExport'))
            ->format('a4')
            ->name($fileName);
    }
}
