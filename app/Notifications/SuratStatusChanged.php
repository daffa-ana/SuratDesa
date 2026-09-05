<?php

namespace App\Notifications;

use App\Models\Surat;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SuratStatusChanged extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Surat $surat,
        private readonly string $message,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Pembaruan surat ' . $this->surat->nomor_surat,
            'message' => $this->message,
            'status' => $this->surat->status,
            'surat_id' => $this->surat->id,
            'url' => route('surat.show', $this->surat),
        ];
    }
}