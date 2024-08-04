<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['parent_id', 'name', 'create_at', 'update_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    public function parent()
    {
        return $this->belongsTo(category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(category::class, 'parent_id');
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_id', 'id');
    }
}
