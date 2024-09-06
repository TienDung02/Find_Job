<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bookmark extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['candidate_id', 'job_id',  'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
