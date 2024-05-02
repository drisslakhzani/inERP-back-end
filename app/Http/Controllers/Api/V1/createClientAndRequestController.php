<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\ClientRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientWelcomeMail;
use App\Services\PdfService;
use Illuminate\Support\Facades\Storage;
use App\Mail\AdminNotificationMail;


class createClientAndRequestController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $clientData = $request->input('clientData');
            $clientData['generatedCode'] = $clientData['generatedCode'];

            $client = Client::create($clientData);

            $requestDetails = $request->input('requestDetails');
            $requestDetails['clients_id'] = $client->id;

            $clientRequest = ClientRequest::create($requestDetails);

            // Commit the transaction if everything is successful
            DB::commit();

            // Generate PDF
            $pdfData = $this->pdfService->generatePdf($client, [$clientRequest]);

            // Save PDF to storage
            $pdfPath = 'pdfs/' . uniqid() . '.pdf';
            Storage::put($pdfPath, $pdfData);

            // Send email to client
            $emailData = [
                'firstName' => $clientData['firstName'],
                'service' => $requestDetails['selectedSolutions'][0]['solution'],
                'generatedCode' => $clientData['generatedCode'],
                'pdfPath' => $pdfPath,
            ];
            Mail::to($clientData['email'])->send(new ClientWelcomeMail($emailData));

            // Send email to admin
            $adminEmailData = [
                'client' => $client,
                'pdfPath' => $pdfPath,
                'clientRequest' => $clientRequest,
            ];
            Mail::to('admin@example.com')->send(new AdminNotificationMail($adminEmailData));

            // Render PDF template with clientRequest data
            $pdfHtml = $this->pdfService->renderTemplate($clientRequest);

            // Return success response
            return response()->json(['success' => true, 'pdfHtml' => $pdfHtml]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

}
