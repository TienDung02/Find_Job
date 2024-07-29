<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_company';

    protected $fillable = ['id_employer', 'company_name', 'company_tagline', 'headquarters', 'latitude', 'longitude', 'company_logo', 'video',
        'since', 'company_website', 'email', 'phone', 'twitter', 'facebook', 'id_industry', 'company_size', 'company_average_salary', 'description', 'header_img', 'active','create_at', 'update_at'];

        const UPDATED_AT = 'update_at';

    public function industry()
    {
        return $this->belongsTo(industry::class, 'id_industry', 'id_industry');
    }
    public function employer()
    {
        return $this->belongsTo(employer::class, 'id_employer', 'id_employer');
    }
}
