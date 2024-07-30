<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'author', 'category_blog_id', 'img', 'desc', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public function categoryBlog()
    {
        return $this->belongsTo(CategoryBlog::class, 'category_blog_id', 'id');
    }
}
