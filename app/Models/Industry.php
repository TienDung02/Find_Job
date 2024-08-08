<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function companies()
    {
        return $this->hasMany(Company::class, 'id', 'id_industry');
    }
}

