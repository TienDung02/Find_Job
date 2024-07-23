<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    use HasFactory;

    protected $primaryKey = 'tag_id';

    protected $fillable = ['name', 'popular', 'create_at', 'update_at'];

}

