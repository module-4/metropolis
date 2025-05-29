<?php

use App\Models\Component;
use App\Models\Simulation;
use App\Models\SimulationComponent;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;

beforeEach(function () {
    Pdf::fake();

    $simulation = Simulation::factory()->create();

    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 1, "y" => 0]);
});

test('/create-report returns a pdf', closure: function () {
    $this->actingAs(User::factory()->create());
    $this->get(route('create-report'))->assertOk();

    $dateOfExport = Carbon::now()->toDateString();

    Pdf::assertRespondedWithPdf(function (PdfBuilder $pdf) use ($dateOfExport) {
        return $pdf->downloadName === 'Simulation Report - ' . $dateOfExport . '.pdf';
    });
});
