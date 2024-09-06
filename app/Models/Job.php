<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Http\Controllers\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Job extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'company_id',
        'title',
        'category_id',
        'job_type_id',
        'province_id',
        'district_id',
        'ward_id',
        'location',
        'tag_id',
        'spotlight',
        'description',
        'job_requirements',
        'benefit',
        'type_salary',
        'salary',
        'minimum_salary',
        'maximum_salary',
        'closing_day',
        'fill',
        'active',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }

    public function jobTag()
    {
        $tagIds = explode(', ', $this->tag_id);

        return Tag::whereIn('id', $tagIds)->pluck('name')->toArray();
    }

    public function applyJobs()
    {
        return $this->hasMany(ApplyJob::class, 'job_id', 'id');
    }


    public function searchable()
    {
    }
    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        $array['tag_names'] = $this->jobTag();
        $array['company_name'] = $this->company->company_name;
        $array['category_name'] = $this->category->name;
        $array['job_type'] = $this->jobType->name;
        $array['province'] = $this->province->name;
        $array['district'] = $this->district->name;
        $array['ward'] = $this->ward->name;

        return $array;
    }
}

