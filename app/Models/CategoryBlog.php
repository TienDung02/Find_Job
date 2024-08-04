<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class CategoryBlog extends Model
    {
        use HasFactory;

        protected $primaryKey = 'id';

        protected $table = 'categories_blogs';

        protected $fillable = [
            'name',
            'description',
            'parent_id',
            'created_at',
            'updated_at',
            'deleted_at'
        ];
        protected $dates = ['deleted_at'];
        public function parent()
        {
            return $this->belongsTo(CategoryBlog::class, 'parent_id');
        }

        public function children()
        {
            return $this->hasMany(CategoryBlog::class, 'parent_id');
        }

    }
