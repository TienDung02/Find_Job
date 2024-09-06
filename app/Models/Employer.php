<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employer extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'avatar',
        'first_name',
        'last_name',
        'tel',
        'email',
        'about',
        'active',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function company()
    {
        return $this->hasOne(Company::class, 'employer_id', 'id');
    }
}
