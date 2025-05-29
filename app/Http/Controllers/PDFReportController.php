<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Spatie\LaravelPdf\Support\pdf;
class PDFReportController extends Controller
{
    public function index() {
        return pdf()
            ->view('report')
            ->name('report');
    }
}
