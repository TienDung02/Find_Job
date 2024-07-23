<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidate_education extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_education';

    protected $fillable = ['id_candidate', 'school_name', 'qualification', 'start_day', 'end_day', 'note', 'create_at', 'update_at'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id_candidate');
    }

}
