<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectUpdated extends Notification
{
    use Queueable;
    public $messageBody;

    /**
     * Create a new notification instance.
     *
     * @param $messageBody
     */
    public function __construct($messageBody)
    {
        $this->messageBody = $messageBody;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Project Update')
                    ->greeting('Hello '.$notifiable->username)
                    ->line('We are Sihr Al Sharaq For Decoration')
                    ->line($this->messageBody)
                    ->line('You can visit our website and check your project progress and files.')
                    ->action('Visit Us', url('/'))
                    ->line('Thank You.');

    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
