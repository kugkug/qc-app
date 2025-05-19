<?php

declare(strict_types=1);
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Enums\Orientation;
use Spatie\LaravelPdf\Facades\Pdf;

class ReportHelper {
    public $data;
    
    public function __construct() {
        
    }

    public function generatePaymentOrderPdf($ref_no): mixed {
        $application = globalHelper()->getUserViaAppRefno($ref_no);
        
        if ($application) {
            $filename = "pdf/Payment-Order-$ref_no.pdf";
            $this->data['application'] = $application;
            $this->data['payment_details'] = globalHelper()->getPaymentDetails($ref_no);
            
            Pdf::view('reports.pdf.payment_order', $this->data)
            ->format(Format::A4)
            ->save("$filename");

            return $filename;
        }

        return "";
    }

    public function generateHealthCardId($ref_no): mixed {
        $application = globalHelper()->getUserViaAppRefno($ref_no);
        
        if ($application) {
            $filename = "pdf/HealthCard-ID-$ref_no.pdf";
            
            $this->data['application'] = $application;
            $this->data['payment_details'] = globalHelper()->getPaymentDetails($ref_no);
            
            // Pdf::view('reports.pdf.health_card', $this->data)
            Pdf::view('reports.pdf.health_certificate', $this->data)            
            ->format(Format::A4)
            ->save("$filename");

            return $filename;
        }

        return "";
    }
}