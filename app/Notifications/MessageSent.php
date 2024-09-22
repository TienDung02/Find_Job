<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Support\Facades\Log;

class MessageSent extends Notification implements ShouldBroadcastNow
{
    use Queueable;
    public $user, $messages, $conversation, $receiver;

    public function __construct($user, $messages, $conversation, $receiver)
    {
        $this->user = $user;
        $this->messages = $messages;
        $this->conversation = $conversation;
        $this->receiver = $receiver;
    }
    public function via($notifiable)
    {
        return ['broadcast'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
//        Log::info('Broadcasting message', [
//            'user_id' => $this->user->id,
//            'conversation_id' => $this->conversation->id,
//            'message_id' => $this->messages->id,
//            'receiver_id' => $this->receiver->id,
//            'messages_unread' => $this->conversation->id,
//        ]);
        return new BroadcastMessage([
            'user_id' => $this->user->id,
            'conversation_id' => $this->conversation->id,
            'message_id' => $this->messages->id,
            'receiver_id' => $this->receiver->id,
        ]);
    }
    public function broadcastOn()
    {
        return new Channel('users.' . $this->receiver->id);
    }


    public function toArray($notifiable)
    {
        return [
        ];
    }
}
