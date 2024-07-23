<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidate_network_profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_network_profile';

    protected $fillable = ['id_candidate', 'name', 'url', 'create_at', 'update_at'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id_candidate');
    }

}
