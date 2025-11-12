<?php

namespace App\Mail;

use App\Models\Workshop;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkshopVerificationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $workshop;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Workshop $workshop, string $status)
    {
        $this->workshop = $workshop;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->status === 'approved'
            ? '🎉 Bengkel Anda Telah Disetujui'
            : '❌ Pengajuan Bengkel Anda Ditolak';

        return $this->subject($subject)
                    ->markdown('emails.workshops.status');
    }
}
