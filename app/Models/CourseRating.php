<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseId',
        'userId',
        'rating',
        'review',
        'createdAt'
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = null;
}
