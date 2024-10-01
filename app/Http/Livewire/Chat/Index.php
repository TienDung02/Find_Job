<?php

namespace App\Http\Livewire\Chat;

use App\Models\ChatList;
use App\Models\ContentChat;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{

    public $conversationId;

    protected $listeners = ['createConversation'];

    public function mount($id = null)
    {
        $this->conversationId = $id;
    }

    public function createConversation($id = null)
    {
        if ($id) {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Có ID: ' . $id]);
        } else {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Không có ID']);
        }
    }
    public function render()
    {
        return view('livewire.frontend.chat.index');
    }
}
