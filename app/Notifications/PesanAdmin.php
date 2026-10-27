<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PesanAdmin extends Notification
{
    use Queueable;

    public $judul;
    public $pesan;
    public $pengirim;

    /**
     * Create a new notification instance.
     */
    public function __construct($judul, $pesan, $pengirim = 'Admin')
    {
        $this->judul = $judul;
        $this->pesan = $pesan;
        $this->pengirim = $pengirim;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'judul' => $this->judul,
            'pesan' => $this->pesan,
            'pengirim' => $this->pengirim,
        ];
    }
}
