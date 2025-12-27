<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;
     protected $table = 'quizattempts';
    protected $fillable = ['quizId','userId','score','attemptDate','timeSpent'];

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quizId');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function studentAnswers() {
        return $this->hasMany(StudentAnswer::class, 'attemptId');
    }
}
