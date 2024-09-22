<?php

namespace App\Http\Livewire\Chat;

use App\Models\ChatList;
use Livewire\Component;

class ChatListSelected extends Component
{
    public $chat_selected;

    public function render()
    {
        $id = auth()->user()->id;

        $this->chat_selected = ChatList::where('last_messages_sender', $id)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$this->chat_selected) {
            $chat_ids = ChatList::where('user_1', $id)
                ->orWhere('user_2', $id)
                ->pluck('id');
            $chat_selected = ChatList::whereIn('id', $chat_ids)
                ->where('messages_unread', 0)
                ->orderBy('created_at', 'DESC')
                ->first();
        }

        if (!$this->chat_selected) {
            $this->chat_selected = ChatList::where('user_1', $id)
                ->orWhere('user_2', $id)
                ->orderBy('created_at', 'DESC')
                ->first();
        }
        if ($this->chat_selected) {
            session()->put('chat_selected_id', $this->chat_selected->id);
        }
        return view('livewire.chat.chat-list-selected', ['chat_selected'=> $this->chat_selected]);
    }
}
