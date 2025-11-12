<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Workshop;

class VerifyWorkshopMail extends Mailable
{
    use Queueable, SerializesModels;

    public Workshop $workshop;

    /**
     * Create a new message instance.
     */
    public function __construct(Workshop $workshop)
    {
        $this->workshop = $workshop;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Verifikasi Bengkel Baru: ' . $this->workshop->name)
            ->view('emails.workshops.verify')
            ->with([
                'workshop' => $this->workshop,
                'verifyUrl' => route('workshop-verify.show', $this->workshop->id),
            ]);
    }
}
