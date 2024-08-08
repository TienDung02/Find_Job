<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['user_name', 'email', 'password', 'role', 'active', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;

}
