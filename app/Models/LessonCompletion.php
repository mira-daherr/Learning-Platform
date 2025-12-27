<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'lessonId',
        'userId',
        'completedDate'
    ];

    public function lesson() {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    const CREATED_AT = 'completedDate';
    const UPDATED_AT = null;
}
