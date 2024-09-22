<?php

namespace App\Http\Livewire\Chat;

use App\Models\ContentChat;
use App\Models\User;
use App\Notifications\MessageRead;
use App\Notifications\MessageSent;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\ChatList;
use Livewire\WithFileUploads;
class Chat extends Component
{
    use WithFileUploads;
    public $chat_selected, $messages_selected, $body, $content, $uploaded_images = [];
    public $loadedMessages = 10;
    public $hasMoreMessages = true;
    public function getListeners()
    {
        $id = auth()->user()->id;
        return [
            'chat_selected' => 'loadMessages',
            'loadMoreMessages' => 'loadMoreMessages',
            "echo:users.{$id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'ChatHandleEvent',
        ];
    }

    public function ChatHandleEvent($event)
    {
        if ($event['type'] == MessageSent::class) {

            if ($event['conversation_id'] == $this->chat_selected->id) {

                $this->dispatchBrowserEvent('scroll-bottom');

                $newMessage = ContentChat::find($event['message_id']);

                /*Push Message*/
                $this->messages_selected->push($newMessage);

                /*Update Message*/
                $newMessage->status_receiver = 'Seen';
                $newMessage->save();

                /*Update Conversation*/
                $update_chatList = ChatList::query()->find($this->chat_selected->id);
//                $update_chatList->messages_unread = 0;
                if ($update_chatList->user_1 == $event['user_id']){
                    $update_chatList->status_user_2 = 'Seen';
                }else{
                    $update_chatList->status_user_1 = 'Seen';
                }
                $update_chatList->save();

                /*Refresh Conversation*/
                $this->emitTo('chat.conversation', 'refresh', $this->chat_selected->id);

                /*Broadcast*/
                $this->chat_selected->Receiver()->notify(new MessageRead($this->chat_selected, $this->chat_selected->Sender()));

            }else{
                $this->emitTo('chat.conversation', 'refresh', $this->chat_selected->id);
            }
        }
    }
    public function loadMessages($chatId)
    {
        if ($this->chat_selected && $chatId != $this->chat_selected->id){
            $this->loadedMessages = 10;
            $this->hasMoreMessages = true;
        }
        $this->chat_selected = ChatList::find($chatId);
        $this->loadMessagesPrevious();
    }
    public function mount()
    {
        $id = auth()->user()->id;
        $user = User::query()->findOrFail($id);

        if ($user->last_message_selected) {
            $this->loadMessages($user->last_message_selected);
        } else {
            $this->chat_selected = null;
            $this->messages_selected = collect();
        }
    }
    public function loadMessagesPrevious()
    {
        if ($this->chat_selected) {
            $messages = ContentChat::query()
                ->where('chat_id', $this->chat_selected->id)
                ->orderBy('created_at', 'DESC')
                ->paginate($this->loadedMessages);

            $this->messages_selected = $messages->getCollection()->reverse()->values();

            if ($messages->total() <= $this->loadedMessages) {
                $this->hasMoreMessages = false;
            }
        }
    }

    public function loadMoreMessages()
    {
        if ($this->chat_selected && $this->hasMoreMessages) {
            $this->loadedMessages += 10;
            $this->loadMessagesPrevious();
            $this->dispatchBrowserEvent('messagesLoaded');
        }

    }

    public function submitForm($chatId)
    {
        if ($this->content != ''){
            $createMessage = ContentChat::create([
                'content' => $this->content,
                'sender_id' => auth()->user()->id,
                'chat_id' => $chatId,
                'status_sender' => 'Sent',
                'status_receiver' => 'Unread',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            /*Push Messages*/
            $this->messages_selected->push($createMessage);

            /*Update ChatList*/
            $update_chatList = ChatList::query()->findOrFail($chatId);
            if ($update_chatList->user_1 == auth()->user()->id) {
                $update_chatList->status_user_1 = 'Sent';
                $update_chatList->status_user_2 = 'Unread';
            } else {
                $update_chatList->status_user_2 = 'Sent';
                $update_chatList->status_user_1 = 'Unread';
            }
//            $update_chatList->increment('messages_unread');
            $update_chatList->messages_unread = $update_chatList->messages_unread + 1;
            $update_chatList->last_messages_sender = auth()->user()->id;
            $update_chatList->last_messages = $this->content;
            $update_chatList->save();

            /*Clear Textarea After submit*/
            $this->content = '';

            /*Refresh Conversation*/
            $this->emitTo('chat.conversation', 'refresh', $chatId);

            /*Broadcast*/
            $user = User::query()->find(auth()->user()->id);
            $this->chat_selected->Receiver()->notify(new MessageSent(
                $user,
                $createMessage,
                $this->chat_selected,
                $this->chat_selected->anotherUser(),
            ));

        }
    }

    public function render()
    {
        if (!$this->chat_selected) {
            return view('livewire.chat.chat', [
                'messages' => false,
            ]);
        }

        return view('livewire.chat.chat', [
            'messages' => true,
        ]);
    }
}
//

