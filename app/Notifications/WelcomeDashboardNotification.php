<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class WelcomeDashboardNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        // Add any properties if needed
    }

    public function via($notifiable)
    {
        return ['database']; // This sends the notification to the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'You successfully created your account!, welcome to ITProLink',
            'type' => 'welcome',
        ];
    }
}
