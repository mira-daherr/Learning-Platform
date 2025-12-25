<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    const CREATED_AT = 'createdat';
    const UPDATED_AT = 'updatedat';

    protected $fillable = [
        'title',
        'shortdescription',
        'longdescription',
        'category',
        'difficulty',
        'thumbnail',
        'createdby',
        'ispublished'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'createdby');
    }
}
