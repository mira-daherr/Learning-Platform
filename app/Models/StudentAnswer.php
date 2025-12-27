<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['attemptId','questionId','answerId','isCorrect','answeredAt'];

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    public function attempt() {
        return $this->belongsTo(QuizAttempt::class, 'attemptId');
    }

    public function question() {
        return $this->belongsTo(Question::class, 'questionId');
    }

    public function answer() {
        return $this->belongsTo(Answer::class, 'answerId');
    }
}
