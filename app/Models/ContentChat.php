<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContentChat extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['chat_id', 'sender_id', 'content',
        'img_1',
        'img_2',
        'img_3',
        'img_4',
        'img_5',
        'img_6',
        'img_7',
        'img_8',
        'img_9',
        'img_10',
        'img_11',
        'img_12',
        'img_13',
        'img_14',
        'img_15',
        'img_16',
        'img_17',
        'img_18',
        'img_19',
        'img_20',
        'status_sender',
        'status_receiver',
        'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function chat()
    {
        return $this->belongsTo(ChatList::class, 'chat_id', 'id');
    }
}
