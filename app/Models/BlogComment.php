<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['blog_id', 'user_id', 'content', 'reply_to',
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
        'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'user_id', 'user_id');
    }
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'user_id', 'user_id');
    }
    public function reply()
    {
        return $this->hasMany(BlogComment::class, 'reply_to');
    }
}
