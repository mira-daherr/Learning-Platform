<?php

namespace App\Http\Controllers;

use App\Models\CourseRating;
use Illuminate\Http\Request;

class CourseRatingController extends Controller
{
    public function index() {
        return CourseRating::with('course', 'user')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'courseId' => 'required|exists:courses,id',
            'userId' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $rating = CourseRating::create($data);
        return response()->json($rating, 201);
    }

    public function show($id) {
        return CourseRating::with('course', 'user')->findOrFail($id);
    }

    public function destroy($id) {
        $rating = CourseRating::findOrFail($id);
        $rating->delete();
        return response()->json(['message' => 'Course rating deleted']);
    }
}
