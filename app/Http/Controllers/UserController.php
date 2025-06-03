<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {

        if ($request->hasFile('image_url')) {
            $filepath = Storage::disk('public')->put('/pictures', $request->file("image_url"));
        }


        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "is_admin" => ($request->role === "admin") ? 1 : 0,
            "image_url" => $filepath ?? null

        ]);

        return response()->json([
            'success' => true,
            'message ' => "user " . $user->name . "  has been added ",
            'data' => $user
        ], 201);
    }

    public function destroy(User $user)
    {

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
