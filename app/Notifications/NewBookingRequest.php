<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NewBookingRequest extends Notification
{
    use Queueable;
    protected $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        $customerName = $this->booking->user->name;
        $postTitle = $this->booking->post->title;

        return (new WebPushMessage)
            ->title("New Booking Request!")
            ->icon('/images/icons/icon-192x192.png')
            ->body("{$customerName} has requested a booking for {$postTitle}.")
            ->data(['url' => route('admin.dashboard')]); // Or a specific admin URL
    }
}
