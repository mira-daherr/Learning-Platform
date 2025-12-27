<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizAttemptController extends Controller
{
    public function index() {
        return QuizAttempt::with('quiz', 'user', 'studentAnswers')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'quizId' => 'required|exists:quizzes,id',
            'userId' => 'required|exists:users,id',
            'score' => 'nullable|integer',
            'timeSpent' => 'nullable|integer',
        ]);

        $attempt = QuizAttempt::create($data);
        return response()->json($attempt, 201);
    }

    public function show($id) {
        return QuizAttempt::with('quiz', 'user', 'studentAnswers')->findOrFail($id);
    }

    public function destroy($id) {
        $attempt = QuizAttempt::findOrFail($id);
        $attempt->delete();
        return response()->json(['message' => 'Quiz attempt deleted']);
    }
}
