<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class industry extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_industry';

    protected $fillable = ['name', 'description', 'create_at', 'update_at'];

//    public function companies()
//    {
//        return $this->hasMany(Company::class, 'industry_id', 'id');
//    }
}

