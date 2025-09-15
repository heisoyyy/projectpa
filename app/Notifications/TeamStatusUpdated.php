<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TeamStatusUpdated extends Notification
{
    use Queueable;

    public $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function via($notifiable)
    {
        return ['database']; // bisa juga: ['mail','database']
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Status tim {$this->team->nama_tim} sekarang: {$this->team->status}",
        ];
    }
}
