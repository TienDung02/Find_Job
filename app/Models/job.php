<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Http\Controllers\DB;
class job extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_id';

    protected $fillable = ['id_company', 'title', 'id_category', 'id_job_type', 'id_location', 'tag_id', 'description', 'job_requirements',
        'minimum_rate', 'maximum_rate', 'minimum_salary', 'maximum_salary', 'closing_day', 'apply', 'active', 'create_at', 'update_at'];

    const UPDATED_AT = 'update_at';

    public function company()
    {
        return $this->belongsTo(company::class, 'id_company', 'id_company');
    }
    public function location()
    {
        return $this->belongsTo(location::class, 'id_location', 'id_location');
    }
    public function job_type()
    {
        return $this->belongsTo(job_type::class, 'id_job_type', 'id_job_type');
    }
    public function category()
    {
        return $this->belongsTo(categories::class, 'id_category', 'id_category');
    }
    public function job_tag()
    {
        return $this->belongsTo(tags::class, 'tag_id', 'tag_id');
    }

}

