<?php

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentShared extends Mailable
{
    use Queueable, SerializesModels;

    public $document;

    public function __construct($document)
    {
        $this->document = $document;
    }

    public function build()
    {
        return $this->subject('Document partagé avec vous')
                    ->view('emails.document_shared');
    }
}
