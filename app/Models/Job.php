<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Http\Controllers\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'company_id',
        'title',
        'category_id',
        'job_type_id',
        'location_id',
        'tag_id',
        'description',
        'job_requirements',
        'minimum_rate',
        'maximum_rate',
        'minimum_salary',
        'maximum_salary',
        'closing_day',
        'apply',
        'active',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function jobTag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

}

