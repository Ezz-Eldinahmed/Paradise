<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentCreated extends Notification
{
    use Queueable;

    public $user_id;
    public $comment_body;
    public $tweet_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_id,$comment_body,$tweet_id)
    {
        $this->user_id      = $user_id;
        $this->comment_body = $comment_body;
        $this->tweet_id     = $tweet_id;
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
            'user' =>$this->user_id,
            'comment_body' =>$this->comment_body,
            'tweet_id' =>$this->tweet_id,
        ];
    }
}
