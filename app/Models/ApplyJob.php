<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ApplyJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['job_id', 'user_id', 'company_id', 'full_name', 'email', 'message', 'cv', 'status', 'rating', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'user_id', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function applicationStatus()
    {
        return $this->belongsTo(ApplicationStatus::class, 'status_id', 'id');
    }
}
