<?php

namespace App\Notifications;

use App\Models\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TripCompletedNotification extends Notification
{
    use Queueable;

    public function __construct(public Trip $trip)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Meditation Trip Completed!')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You completed a meditation trip.')
            ->line('Duration: ' . gmdate('i:s', $this->trip->duration) . ' minutes')
            ->line('Satisfaction: ' . str_repeat('⭐', $this->trip->satisfaction))
            ->action('View Trip', route('trips.show', $this->trip->id))
            ->line('Keep up the great work with your meditation practice!');
    }
}
