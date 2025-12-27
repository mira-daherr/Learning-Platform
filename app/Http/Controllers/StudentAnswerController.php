<?php

namespace App\Http\Controllers;

use App\Models\StudentAnswer;
use Illuminate\Http\Request;

class StudentAnswerController extends Controller
{
    public function index() {
        return StudentAnswer::with('quizAttempt', 'question', 'answer')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'attemptId' => 'required|exists:quizAttempts,id',
            'questionId' => 'required|exists:questions,id',
            'answerId' => 'required|exists:answers,id',
            'isCorrect' => 'boolean'
        ]);

        $studentAnswer = StudentAnswer::create($data);
        return response()->json($studentAnswer, 201);
    }

    public function show($id) {
        return StudentAnswer::with('quizAttempt', 'question', 'answer')->findOrFail($id);
    }

    public function destroy($id) {
        $studentAnswer = StudentAnswer::findOrFail($id);
        $studentAnswer->delete();
        return response()->json(['message' => 'Student answer deleted']);
    }
}
