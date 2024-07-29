<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidate extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_candidate';

    protected $fillable = ['id_user', 'avatar', 'first_name', 'last_name', 'tel', 'about', 'active', 'create_at', 'update_at'];

    const UPDATED_AT = 'update_at';
    public function users()
    {
        return $this->belongsTo(users::class, 'id_user', 'id_user');
    }
    public function educations()
    {
        return $this->hasMany(candidate_education::class, 'id_candidate', 'id_candidate');
    }
    public function experience()
    {
        return $this->hasMany(candidate_experience::class, 'id_candidate', 'id_candidate');
    }
    public function network_profile()
    {
        return $this->hasMany(candidate_network_profile::class, 'id_candidate', 'id_candidate');
    }
}
