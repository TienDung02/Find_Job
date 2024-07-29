<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_category';

    protected $fillable = ['parent_id', 'name', 'create_at', 'update_at'];

//    const CREATED_AT = 'create_at';
//    const UPDATED_AT = 'update_at';
    public $timestamps = false;
    public function parent()
    {
        return $this->belongsTo(categories::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(categories::class, 'parent_id');
    }
}
