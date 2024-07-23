<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_id';

    protected $fillable = ['id_employer', 'title', 'category', 'job_type', 'location', 'job_tag', 'description', 'job_requirements',
        'minimum_rate', 'maximum_rate', 'minimum_salary', 'maximum_salary', 'closing_day', 'apply', 'active', 'create_at', 'update_at'];

    public function employer()
    {
        return $this->belongsTo(employer::class, 'id_employer', 'id_employer');
    }

}

