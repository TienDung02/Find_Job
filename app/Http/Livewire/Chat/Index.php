<?php

namespace App\Http\Livewire\Chat;

use App\Models\ChatList;
use App\Models\ContentChat;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.chat.index');
    }
}
