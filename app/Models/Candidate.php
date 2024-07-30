<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'avatar',
        'first_name',
        'last_name',
        'tel',
        'about',
        'active',
        'created_at',
        'updated_at'

    ];
    protected $dates = ['deleted_at'];
//    const UPDATED_AT = 'updated_at';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function educations()
    {
        return $this->hasMany(CandidateEducation::class, 'candidate_id', 'id');
    }

    public function experiences()
    {
        return $this->hasMany(CandidateExperience::class, 'candidate_id', 'id');
    }

    public function networkProfiles()
    {
        return $this->hasMany(CandidateNetworkProfile::class, 'candidate_id', 'id');
    }
}
