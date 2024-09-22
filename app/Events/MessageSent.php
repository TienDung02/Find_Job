<?php
//
//namespace App\Events;
//
//use App\Models\ChatList;
//use App\Models\ContentChat;
//use App\Models\User;
//use Illuminate\Broadcasting\Channel;
//use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
//use Illuminate\Foundation\Events\Dispatchable;
//use Illuminate\Queue\SerializesModels;
//
//class MessageSent implements ShouldBroadcastNow
//{
//    use Dispatchable, InteractsWithSockets, SerializesModels;
//
//    public $user, $messages, $conversation, $receiver;
//    public function __construct(User $user, ContentChat $messages, ChatList $conversation, User $receiver)
//    {
////        $this->user = $user;
//        $this->messages = $messages;
////        $this->conversation = $conversation;
////        $this->receiver = $receiver;
//    }
//
//    public function broadcastWith(){
//        return [
////            'user' => $this->user,
//            'messages' => $this->messages->id,
////            'conversation' => $this->conversation->id,
////            'receiver' => $this->receiver->id,
//        ];
//    }
//
//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return \Illuminate\Broadcasting\Channel|array
//     */
////    public function broadcastOn()
////    {
////
//////        return new PrivateChannel('chat.' .$this->messages->id);
////    }
//}
