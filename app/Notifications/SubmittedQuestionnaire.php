<?php

namespace App\Notifications;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubmittedQuestionnaire extends Notification
{
    use Queueable;
    /**
     * @var Questionnaire
     */
    public $questionnaire;

    /**
     * Create a new notification instance.
     *
     * @param Questionnaire $questionnaire
     */
    public function __construct(Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->line('Hello! Register questionnaire in Shir Al-Sharq')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
//            'body' =>' has submitted a new questionnaire',
            'QuestionnaireId' => $this->questionnaire->id,
            'userId' =>  $this->questionnaire->user->id,
            'username'=> User::find($this->questionnaire->user->id)->username
        ];
    }
}
