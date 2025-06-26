<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class BookingStatusUpdated extends Notification
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

    /**
     * Get the web representation of the notification.
     */
    public function toWebPush($notifiable, $notification)
    {
        $statusLabel = $this->booking->status->getLabel();
        $postTitle = $this->booking->post->title;

        return (new WebPushMessage)
            ->title("Booking Status Updated!")
            ->icon('/images/icons/icon-192x192.png')
            ->body("Your booking for {$postTitle} has been updated to: {$statusLabel}")
            ->data(['url' => route('booking.detail', $this->booking->id)]);
    }
}
