<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ChatList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chat_lists';

    protected $primaryKey = 'id';

    protected $fillable = ['user_1', 'user_2', 'last_messages', 'last_messages_sender', 'messages_unread', 'status_user_1', 'status_user_2',  'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function chatContentsUnread()
    {
        return $this->hasMany(ContentChat::class, 'chat_id', 'id')
            ->where('status_receiver', 'Unread');
    }
    public function me()
    {
        return auth()->user()->id == $this->user_1 ? User::firstWhere('id', $this->user_1) : User::firstWhere('id', $this->user_2);
    }
    public function anotherUser()
    {
        return auth()->user()->id == $this->user_1 ? User::firstWhere('id', $this->user_2) : User::firstWhere('id', $this->user_1);
    }
    public function Sender()
    {
        return User::firstWhere('id', $this->last_messages_sender);
    }

    public function Receiver()
    {
        return $this->last_messages_sender == $this->user_1 ? User::firstWhere('id', $this->user_2) : User::firstWhere('id', $this->user_1)   ;
    }

    public function statusSender()
    {
        return $this->last_messages_sender == $this->user_1 ? $this->status_user_1 : $this->status_user_2;
    }

    public function statusReceiver()
    {
        return $this->last_messages_sender == $this->user_1 ? $this->status_user_2 : $this->status_user_1;
    }
}
