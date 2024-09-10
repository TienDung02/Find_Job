<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ChatList extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['user_1', 'user_2', 'last_messages', 'status_user_1', 'status_user_2',  'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function user1()
    {
        return $this->belongsTo(User::class, 'user_1', 'id');
    }
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_2', 'id');
    }
    public function chatContentsUnread()
    {
        return $this->hasMany(ContentChat::class, 'chat_id', 'id')
            ->where('status_receiver', 'Unread');
    }
}
