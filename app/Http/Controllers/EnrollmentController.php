<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index() {
        return Enrollment::with('course', 'user')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'courseId' => 'required|exists:courses,id',
            'userId' => 'required|exists:users,id',
            'status' => 'sometimes|in:active,completed,cancelled'
        ]);

        $enrollment = Enrollment::create($data);
        return response()->json($enrollment, 201);
    }

    public function show($id) {
        return Enrollment::with('course', 'user')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $enrollment = Enrollment::findOrFail($id);
        $data = $request->validate([
            'status' => 'sometimes|in:active,completed,cancelled'
        ]);
        $enrollment->update($data);
        return response()->json($enrollment);
    }

    public function destroy($id) {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();
        return response()->json(['message' => 'Enrollment deleted']);
    }
}
