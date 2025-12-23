<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::all(), 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:student,teacher,admin',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return response()->json(['message' => 'User created successfully','user' => $user], 201);
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

  public function update(Request $request, User $user) 
{
    $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user->id)],
        'password' => 'sometimes|string|min:6',
        'role' => 'sometimes|in:student,teacher,admin',
    ]);

    if(isset($validated['name'])) $user->name = $validated['name'];
    if(isset($validated['email'])) $user->email = $validated['email'];
    if(isset($validated['password'])) $user->password = Hash::make($validated['password']);
    if(isset($validated['role'])) $user->role = $validated['role'];

    $user->save();

    return response()->json(['message' => 'User updated successfully','user'=>$user], 200);
}

   public function destroy(User $user)
{
    $user->delete();

    return response()->json([
        'message' => 'User deleted successfully'
    ], 200);
}

}
