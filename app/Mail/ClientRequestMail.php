<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $pdfPath;
    public $clientRequest;

    /**
     * Create a new message instance.
     *
     * @param array $adminEmailData
     */
    public function __construct($adminEmailData)
    {
        $this->client = $adminEmailData['client'];
        $this->pdfPath = $adminEmailData['pdfPath'];
        $this->clientRequest = $adminEmailData['clientRequest'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.client_notification');
    }
}
