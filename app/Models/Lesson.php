<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';

    
    protected $fillable = [
        'courseId',
        'title',
        'content',
        'videoUrl',
        'lessonOrder',
        'estimatedDuration'
    ];

  
    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

 
    public function completions()
    {
        return $this->hasMany(LessonCompletion::class, 'lessonId');
    }

  
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}
