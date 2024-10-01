<?php

namespace App\Http\Livewire\Chat;
use App\Models\ChatList;
use App\Models\ContentChat;
use App\Models\User;
use App\Notifications\MessageRead;
use App\Notifications\MessageSent;
use Livewire\Component;

class Conversation extends Component
{
    public $chatSelected_id, $chat_selected;

//    protected $listeners = ['refresh' => 'handleRefresh'];

    public function getListeners()
    {
        $id = auth()->user()->id;
        return [
            'refresh' => 'handleRefresh',
            'createConversation' => 'createConversation',
            "echo:users.{$id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'ConversationHandleEvent',
        ];
    }

    public function ConversationHandleEvent($event)
    {

        if ($event['type'] == MessageRead::class) {
            $this->emitSelf('$refresh');
        }
    }
    public function handleRefresh($chatId)
    {
        $this->mount();
        $this->chatSelected_id = $chatId;
        $this->emitSelf('$refresh');
    }

    public function getChatSelected($id){
        $user = User::query()->findOrFail($id);
        $this->chat_selected = ChatList::query()->find($user->last_message_selected);
        if ($this->chat_selected){
            $this->updateChatList($this->chat_selected, $id);
            $this->emit('chat_selected', $this->chat_selected->id);
            $this->chatSelected_id = $this->chat_selected->id;

            /*Update ChatList*/
            if ($this->chat_selected->last_messages_sender != auth()->user()->id){
                if ($this->chat_selected->user_1 == auth()->user()->id){
                    $this->chat_selected->status_user_1 = 'Seen';
                }else{
                    $this->chat_selected->status_user_2 = 'Seen';
                }
                $this->chat_selected->messages_unread = 0;
                $this->chat_selected->save();

                /*Update Messages Status*/
                $update_messages = ContentChat::query()->where('chat_id', $this->chat_selected->id)->get();
                foreach ($update_messages as $mess){
                    $mess->status_receiver = 'Seen';
                    $mess->save();
                }
            }
        }
    }
    public function updateChatList($chatList_update, $id){
        if ($chatList_update->last_messages_sender != auth()->user()->id){
            $chatList_update->messages_unread = 0;
        }
        if ($chatList_update->user_1 == $id && $chatList_update->last_messages_sender != $id){
            $chatList_update->status_user_1 = 'Seen';
        }elseif($chatList_update->user_2 == $id && $chatList_update->last_messages_sender != $id){
            $chatList_update->status_user_2 = 'Seen';
        }
        $chatList_update->save();
    }
    public function selectChat($chatId)
    {
        if ($chatId){

            /*Update ChatList*/
            $chatList_update = ChatList::query()->findOrFail($chatId);

            if ($chatList_update->messages_unread != 0 && $chatList_update->last_messages_sender != auth()->user()->id){
                /*Broadcast*/
                $chatList_update->Receiver()->notify(new MessageRead($chatList_update, $chatList_update->Sender()));
            }

            $this->updateChatList($chatList_update, auth()->user()->id);
            $this->chatSelected_id = $chatId;

            /*Update User*/
            $user_update = User::query()->findOrFail(auth()->user()->id);
            $user_update->last_message_selected = $chatId;
            $user_update->save();

            $this->mount();
        }
    }

    public function createConversation(){
        dd('aaaaaaaaaaa');
    }
    public function mount(){
        $id = auth()->user()->id;
        $this->getChatSelected($id);

        $this->data_chat_list = ChatList::query()
            ->where('user_1', $id)
            ->orWhere('user_2', $id)
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('livewire.chat.conversation');
    }
}
