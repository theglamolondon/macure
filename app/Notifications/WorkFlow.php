<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class WorkFlow extends Notification implements ShouldQueue
{
    use Queueable;

    private $message;
    private $link;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $link)
    {
        $this->message = $message;
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
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
            "message" => $this->message,
            "link" => $this->link
        ];
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            "message" => $this->message,
            "link" => $this->link,
            "from" => Auth::user()->id
        ]);
    }
}
