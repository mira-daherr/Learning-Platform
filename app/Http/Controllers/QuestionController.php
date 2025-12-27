<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index() {
        return Question::with('quiz', 'answers')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'quizId' => 'required|exists:quizzes,id',
            'questionText' => 'required|string',
            'questionType' => 'nullable|in:single,multiple'
        ]);

        $question = Question::create($data);
        return response()->json($question, 201);
    }

    public function show($id) {
        return Question::with('quiz', 'answers')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $question = Question::findOrFail($id);
        $data = $request->validate([
            'questionText' => 'sometimes|string',
            'questionType' => 'nullable|in:single,multiple'
        ]);
        $question->update($data);
        return response()->json($question);
    }

    public function destroy($id) {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted']);
    }
}
