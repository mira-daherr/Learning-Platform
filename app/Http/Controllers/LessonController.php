<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
 
    public function index()
    {
        return Lesson::with('course')->orderBy('lessonOrder')->get();
    }


    public function show($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);
        return response()->json($lesson);
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'courseId' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'videoUrl' => 'nullable|url',
            'lessonOrder' => 'nullable|integer',
            'estimatedDuration' => 'nullable|integer',
        ]);

        $lesson = Lesson::create($data);

        return response()->json($lesson, 201);
    }

   
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        $data = $request->validate([
            'courseId' => 'sometimes|exists:courses,id',
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'videoUrl' => 'nullable|url',
            'lessonOrder' => 'nullable|integer',
            'estimatedDuration' => 'nullable|integer',
        ]);

        $lesson->update($data);

        return response()->json($lesson);
    }

  
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return response()->json(['message' => 'Lesson deleted successfully.']);
    }
}
