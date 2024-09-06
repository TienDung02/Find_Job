<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatus;
use App\Models\ApplyJob;
use App\Models\Candidate;
use App\Models\ChatList;
use App\Models\Company;
use App\Models\ContentChat;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    public function index()
    {
        $data_chat_list = ChatList::query()->where('user_1', \auth()->user()->id)->orWhere('user_2', \auth()->user()->id)->get();
        $last_messages = ContentChat::query()
            ->where('sender_id', \auth()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->first();
        $messages = ContentChat::query()->where('chat_id', $last_messages->chat_id)->orderBy('updated_at', 'desc')->limit(10)->get();
        $chat_selected = ChatList::query()->where('id', $last_messages->chat_id)->first();
        foreach ($data_chat_list as $key => $chat_list){
            if ($chat_list->id == $last_messages->chat_id){
                unset($data_chat_list[$key]);
            }
        }
        return view('livewire.frontend.chat.index', compact('data_chat_list', 'messages', 'last_messages', 'chat_selected'));
    }
}
