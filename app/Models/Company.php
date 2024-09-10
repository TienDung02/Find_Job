<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'employer_id',
        'company_name',
        'company_tagline',
        'province_id',
        'district_id',
        'ward_id',
        'headquarters',
        'company_logo',
        'company_website',
        'email',
        'phone',
        'twitter',
        'facebook',
        'industry_id',
        'company_size',
        'description',
        'active',
        'create_at',
        'update_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
