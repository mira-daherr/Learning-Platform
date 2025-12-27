<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index() {
        return Certificate::with('course', 'user')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'courseId' => 'required|exists:courses,id',
            'userId' => 'required|exists:users,id',
            'downloadUrl' => 'nullable|string',
        ]);

        $certificate = Certificate::create($data);
        return response()->json($certificate, 201);
    }

    public function show($id) {
        return Certificate::with('course', 'user')->findOrFail($id);
    }

    public function destroy($id) {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        return response()->json(['message' => 'Certificate deleted']);
    }
}
