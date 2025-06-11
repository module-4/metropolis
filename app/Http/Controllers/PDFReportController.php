<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Browsershot\Browsershot;
use function Spatie\LaravelPdf\Support\pdf;
class  PDFReportController extends Controller
{
    public function show() {

        $simulation = Simulation::firstOrCreate([], ["alias" => "simulation_1"]);
        $totalEffects = $simulation->getGridEffects();
        $simulationComponents = $simulation->components;

        $dateOfExport = Carbon::now()->toDateString();
        $fileName = 'Simulation Report - ' . $dateOfExport;

        return pdf()
            ->withBrowsershot(function (Browsershot $browsershot) {
                $browsershot->noSandbox();
            })
            ->view('report', compact('simulation', 'totalEffects', 'simulationComponents', 'dateOfExport'))
            ->format('a4')
            ->name($fileName);
    }
}
