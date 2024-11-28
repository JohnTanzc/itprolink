<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // Ensures the notification is sent via email.
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Generate the reset URL with the token
        $resetUrl = url(route('password.reset', ['token' => $this->token]));

        // Return the mail message
        return (new MailMessage)
            ->subject('Password Reset Request') // Subject line for the email
            ->greeting("Hello, {$notifiable->fname} {$notifiable->lname}") // Personalize the greeting with the user's name
            ->line('We received a request to reset your password. Click the button below to reset it:') // Informational message
            ->action('Reset Password', $resetUrl) // Action button for password reset
            ->line('If you did not request a password reset, please ignore this email.')
            ->line('Thank you for using our application!')
            ->salutation('Best regards, ITProLink');
    }
}
