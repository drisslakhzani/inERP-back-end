<?php

namespace App\Services;

use Dompdf\Dompdf;

class PdfService
{
    public function generatePdf($client, $requests)
    {
        $html = view('pdf.template', compact('client', 'requests'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }

    public function renderTemplate($clientRequest)
    {
        // Pass $clientRequest to the view along with other data
        return view('pdf.template', ['clientRequest' => $clientRequest]);
    }
}
