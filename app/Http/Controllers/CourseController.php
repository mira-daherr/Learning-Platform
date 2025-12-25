<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return Course::with('instructor')->get();
        }

        return Course::where('ispublished', true)
                     ->with('instructor')
                     ->get();
    }

    
    public function show($id)
    {
        $course = Course::with('instructor')->findOrFail($id);

        if (!$course->ispublished && auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $course;
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'shortdescription' => 'required|string|max:255',
            'longdescription' => 'required|string',
            'category' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'thumbnail' => 'nullable|string',
            'ispublished' => 'boolean'
        ]);

        $data['createdby'] = auth()->id();

        $course = Course::create($data);

        return response()->json($course, 201);
    }

    
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'shortdescription' => 'sometimes|string|max:255',
            'longdescription' => 'sometimes|string',
            'category' => 'sometimes|string',
            'difficulty' => 'sometimes|in:beginner,intermediate,advanced',
            'thumbnail' => 'nullable|string',
            'ispublished' => 'boolean'
        ]);

        $course->update($data);

        return response()->json($course);
    }

   
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }

  
    public function togglePublish($id)
    {
        $course = Course::findOrFail($id);
        $course->ispublished = !$course->ispublished;
        $course->save();

        return response()->json(['ispublished' => $course->ispublished]);
    }
}
