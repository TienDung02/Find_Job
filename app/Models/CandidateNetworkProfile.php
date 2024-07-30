<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateNetworkProfile extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['candidate_id', 'name', 'url', 'create_at', 'update_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

}
