<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index() {
        return Answer::with('question')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'questionId' => 'required|exists:questions,id',
            'answerText' => 'required|string',
            'isCorrect' => 'boolean'
        ]);

        $answer = Answer::create($data);
        return response()->json($answer, 201);
    }

    public function show($id) {
        return Answer::with('question')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $answer = Answer::findOrFail($id);
        $data = $request->validate([
            'answerText' => 'sometimes|string',
            'isCorrect' => 'boolean'
        ]);
        $answer->update($data);
        return response()->json($answer);
    }

    public function destroy($id) {
        $answer = Answer::findOrFail($id);
        $answer->delete();
        return response()->json(['message' => 'Answer deleted']);
    }
}
