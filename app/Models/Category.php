<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['parent_id', 'name', 'create_at', 'update_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    public function parent()
    {
        return $this->belongsTo(category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(category::class, 'parent_id');
    }
}
