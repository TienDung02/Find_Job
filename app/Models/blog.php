<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_blog';

    protected $fillable = ['title', 'author', 'id_category_blog', 'img', 'desc', 'create_at', 'update_at'];

    public function category_blog()
    {
        return $this->belongsTo(category_blog::class, 'id_category_blog', 'id_category_blog');
    }

}
