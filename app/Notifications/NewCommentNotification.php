<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    public function __construct(public Comment $comment)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Comment on Your Trip')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line($this->comment->user->name . ' commented on your meditation trip.')
            ->line('"' . $this->comment->content . '"')
            ->action('View Trip', route('trips.show', $this->comment->trip_id))
            ->line('Thank you for being part of our community!');
    }
}
