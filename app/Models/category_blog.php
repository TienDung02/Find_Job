<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_blog extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_category_blog';

    protected $fillable = ['name', 'description', 'parent_id', 'create_at', 'update_at'];


}
