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
        'headquarters',
        'latitude',
        'longitude',
        'company_logo',
        'video',
        'since',
        'company_website',
        'email',
        'phone',
        'twitter',
        'facebook',
        'industry_id',
        'company_size',
        'company_average_salary',
        'description',
        'header_img',
        'active',
        'create_at',
        'update_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
}
