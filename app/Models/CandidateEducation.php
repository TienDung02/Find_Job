<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateEducation extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'candidate_educations';
    protected $fillable = [
        'resume_id',
        'school_name',
        'qualification',
        'start_day',
        'end_day',
        'note',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;
    protected $dates = ['deleted_at'];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

}
