<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class JobAlert extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['candidate_id', 'alert_name', 'keyword', 'province_id', 'frequency_id', 'tag_id', 'job_type_id', 'industry_id', 'min_salary', 'max_salary', 'active','created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function job_type()
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
    public function frequency()
    {
        return $this->belongsTo(Frequency::class, 'frequency_id', 'id');
    }
}
