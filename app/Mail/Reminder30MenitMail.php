<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reminder30MenitMail extends Mailable
{
    use SerializesModels;

    public $jadwal;

    public function __construct($jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function build()
    {
        return $this->subject('⏰ Reminder 30 Menit Sebelum Tampil')
                    ->view('emails.reminder-30-menit');
    }
}
