<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index() {
        return Quiz::with('course', 'lesson', 'questions.answers')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'courseId' => 'required|exists:courses,id',
            'lessonId' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'passingScore' => 'nullable|integer',
            'timeLimit' => 'nullable|integer',
        ]);

        $quiz = Quiz::create($data);
        return response()->json($quiz, 201);
    }

    public function show($id) {
        return Quiz::with('course', 'lesson', 'questions.answers')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $quiz = Quiz::findOrFail($id);
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'passingScore' => 'nullable|integer',
            'timeLimit' => 'nullable|integer',
        ]);
        $quiz->update($data);
        return response()->json($quiz);
    }

    public function destroy($id) {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return response()->json(['message' => 'Quiz deleted']);
    }
}
