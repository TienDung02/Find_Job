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
        $selected_content_chat = 1;
        $id = Session::get('user_data.id');
        $data_chat_list = ChatList::query()->where('user_1', $id)->orWhere('user_2', $id)->get();
        $chat_selected = ChatList::query()
            ->where('last_messages_sender', $id)
            ->orderBy('created_at', 'DESC')
            ->first();
        if ($chat_selected == null) {
            $chat_ids = $data_chat_list->pluck('id');
            $chat_selected = ChatList::query()
                ->whereIn('id', $chat_ids)
                ->where('messages_unread', 0)
                ->orderBy('created_at', 'DESC')
                ->first();
        }
        if ($chat_selected == null) {
            $selected_content_chat = 0;
            $chat_selected = ChatList::query()->where('user_1', $id)->orWhere('user_2', $id)->orderBy('created_at', 'DESC')->first();
        }
        $check_messages_prev= false;
        if ($selected_content_chat == 1){
            $hasMoreMessages = ContentChat::query()
                ->where('chat_id', $chat_selected->id)
                ->orderBy('created_at', 'DESC')
                ->skip(10)
                ->take(1)
                ->get();
            if ($hasMoreMessages->isNotEmpty()){
                $check_messages_prev= true;
            }
        }
        $messages_selected = null;
        if ($chat_selected != null){
            $messages_selected = ContentChat::query()->where('chat_id', $chat_selected->id)->paginate(10);
        }
        foreach ($data_chat_list as $key => $chat_list){
            if ($chat_list->id == $chat_selected->id){
                unset($data_chat_list[$key]);
            }
        }
        return view('livewire.frontend.chat.index', compact('data_chat_list',  'chat_selected', 'selected_content_chat', 'messages_selected', 'check_messages_prev'));
    }
    public function change_messages(Request $request){
        $messages_selected = ContentChat::query()->where('chat_id', $request->id)->paginate(10);
        $messages_update = ContentChat::query()->where('chat_id', $request->id)->get();
        foreach ($messages_update as $update){
            $update->status_receiver = 'Seen';
            $update->save();
        }
        $chatList_update = ChatList::query()->find($request->id);
        if ($chatList_update->user_1 == Session::get('user_data.id')){
            $chatList_update->status_user_1 = 'Seen';
        }else{
            $chatList_update->status_user_2 = 'Seen';
        }
        $chatList_update->save();
        $check_messages_prev= false;
        $hasMoreMessages = ContentChat::query()
            ->where('chat_id', $request->id)
            ->orderBy('created_at', 'DESC')
            ->skip(10)
            ->take(1)
            ->get();
        if ($hasMoreMessages->isNotEmpty()){
            $check_messages_prev= true;
        }
        return view('livewire.frontend.ajax.change_messages', compact( 'messages_selected', 'check_messages_prev'));
    }
}
