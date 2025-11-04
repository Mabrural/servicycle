<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BookingService;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $subjectLine;
    public $messageContent;

    /**
     * Create a new message instance.
     */
    public function __construct(BookingService $booking)
    {
        $this->booking = $booking;

        // Tentukan isi email berdasarkan status booking
        switch ($booking->status) {
            case 'diterima':
                $this->subjectLine = 'Booking Anda Diterima!';
                $this->messageContent = 'Silakan antar kendaraan Anda ke bengkel sesuai jadwal yang ditentukan.';
                break;

            case 'ditolak':
                $this->subjectLine = 'Booking Anda Ditolak';
                $this->messageContent = 'Mohon maaf, permintaan booking Anda ditolak oleh bengkel. Silakan coba lagi.';
                break;

            case 'dikerjakan':
                $this->subjectLine = 'Servis Kendaraan Anda Sedang Dikerjakan';
                $this->messageContent = 'Bengkel sedang mengerjakan servis kendaraan Anda.';
                break;

            case 'selesai':
                $this->subjectLine = 'Servis Kendaraan Anda Selesai';
                $this->messageContent = 'Servis kendaraan Anda telah selesai. Silakan ambil kendaraan Anda di bengkel.';
                break;

            case 'diambil':
                $this->subjectLine = 'Kendaraan Anda Telah Diambil';
                $this->messageContent = 'Terima kasih telah menggunakan layanan kami. Sampai jumpa di servis berikutnya!';
                break;

            default:
                $this->subjectLine = 'Perubahan Status Booking Servis';
                $this->messageContent = 'Status booking Anda telah diperbarui.';
                break;
        }
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subjectLine)
            ->view('emails.booking-status')
            ->with([
                'booking' => $this->booking,
                'messageContent' => $this->messageContent,
                'subjectLine' => $this->subjectLine,
            ]);
    }
}
