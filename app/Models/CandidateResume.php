<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
class CandidateResume extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'candidate_id',
        'full_name',
        'email',
        'professional_title',
        'province_id',
        'district_id',
        'ward_id',
        'photo',
        'type_salary',
        'salary',
        'minimum_salary',
        'maximum_salary',
        'resume_content',
    ];
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
    public function educations()
    {
        return $this->hasMany(CandidateEducation::class, 'resume_id', 'id');
    }
    public function experiences()
    {
        return $this->hasMany(CandidateExperience::class, 'resume_id', 'id');
    }
    public function networkProfiles()
    {
        return $this->hasMany(CandidateNetworkProfile::class, 'resume_id', 'id');
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
    public function searchable()
    {
    }
    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        $array['tag_names'] = $this->jobTag();
        $array['id'] = $this->id;
        $array['province'] = $this->province->name;
        $array['district'] = $this->district->name;
        $array['ward'] = $this->ward->name;

        return $array;
    }
}
