<?php

declare(strict_types=1);
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;

class ReportModulesController extends Controller
{
    
    public function viewPdf() {
        
        Pdf::view('reports.pdf.invoice')
        ->format(Format::A4)
        ->save('pdf/invoice.pdf');
    }
}