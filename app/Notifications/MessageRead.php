<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
class MessageRead extends Notification
{
    use Queueable;
    public $conversation, $user;

    public function __construct($conversation, $user)
    {
        $this->user=$user;
        $this->conversation=$conversation;
    }

    public function via($notifiable)
    {
        return ['broadcast'];
    }
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'user_id' => $this->user->id,
            'conversation_id' => $this->conversation->id,
        ]);
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function broadcastOn()
    {
        return new Channel('users.' . $this->user->id);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
