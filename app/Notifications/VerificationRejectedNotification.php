<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class VerificationRejectedNotification extends Notification
{
    private $reason;

    // Constructor to accept the rejection reason dynamically
    public function __construct($reason)
    {
        $this->reason = $reason; // Store the rejection reason
    }

    // Determine the delivery channels for the notification
    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    // Store the notification in the database
    public function toDatabase($notifiable)
    {
        // Store the notification data in the database
        return [
            'title' => 'Verification Rejected',
            'message' => $this->reason,  // Store the custom rejection message
        ];
    }
}
