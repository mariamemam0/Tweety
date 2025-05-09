<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     public $follower;
    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('You have a new follower!')
        ->greeting('Hi ' . $notifiable->name . ',')
        ->line($this->follower->name . ' has followed you.')
        ->action('View Profile', url('/profile/' . $this->follower->username))
        ->line('Thanks for using our app!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "{$this->follower->name} followed you",
            'follower_id' => $this->follower->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "{$this->follower->name} followed you",
            'follower_id' => $this->follower->id,
        ];
    }
}
