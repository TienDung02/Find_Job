<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_employer';

    protected $fillable = ['id_user', 'avatar', 'first_name', 'last_name', 'tel', '	email', 'about', 'active', 'create_at', 'update_at'];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'id_employer', 'id_employer');
    }
}
