<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quizId',
        'questionText',
        'questionType'
    ];
     const CREATED_AT = 'createdAt';
     const UPDATED_AT = 'updatedAt';

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quizId');
    }

    public function answers() {
        return $this->hasMany(Answer::class, 'questionId');
    }
}
