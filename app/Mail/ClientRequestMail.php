<?php


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $pdfUrl;

    public function __construct($client, $pdfPath)
    {
        $this->client = $client;
        $this->pdfUrl = asset($pdfPath);
    }

    public function build()
    {
        return $this->view('emails.client_request');
    }
}
