<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidate_experience extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_experience';

    protected $fillable = ['id_candidate', 'Employer', 'job_title', 'start_day', 'end_day', 'note', 'create_at', 'update_at'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id_candidate');
    }

}
