<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function read(DatabaseNotification $notification): RedirectResponse
    {
        abort_unless(
            $notification->notifiable_type === User::class
                && (int) $notification->notifiable_id === (int) auth()->id(),
            403
        );

        $notification->markAsRead();

        return to_route('surat.show', $notification->data['surat_id']);
    }
}