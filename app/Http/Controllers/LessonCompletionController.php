<?php

namespace App\Http\Controllers;

use App\Models\LessonCompletion;
use Illuminate\Http\Request;

class LessonCompletionController extends Controller
{
    public function index() {
        return LessonCompletion::with('lesson', 'user')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'lessonId' => 'required|exists:lessons,id',
            'userId' => 'required|exists:users,id',
        ]);

        $completion = LessonCompletion::create($data);
        return response()->json($completion, 201);
    }

    public function show($id) {
        return LessonCompletion::with('lesson', 'user')->findOrFail($id);
    }

    public function destroy($id) {
        $completion = LessonCompletion::findOrFail($id);
        $completion->delete();
        return response()->json(['message' => 'Lesson completion deleted']);
    }
}
