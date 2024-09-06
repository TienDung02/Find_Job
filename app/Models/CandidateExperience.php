<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateExperience extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'candidate_experiences';
    protected $fillable = [
        'resume_id',
        'employer',
        'job_title',
        'start_day',
        'end_day',
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
        'deleted_at'
    ];

    public $timestamps = true;
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
}
