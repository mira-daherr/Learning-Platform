<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseId',
        'lessonId',
        'title',
        'passingScore',
        'timeLimit'
    ];
      const CREATED_AT = 'createdAt';
     const UPDATED_AT = 'updatedAt';

    public function course() {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }

    public function questions() {
        return $this->hasMany(Question::class, 'quizId');
    }
}
