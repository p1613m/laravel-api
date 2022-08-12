<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        User::query()->create([
            'password' => Hash::make($request->password),
        ] + $request->validated());

        return response()->json([
            'message' => 'Success',
        ], 200);
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::query()->where('email', $request->email)->first();
        if($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Success',
                'token' => $user->generateToken(),
            ]);
        }

        return response()->json([
            'message' => 'Error',
            'errors' => [
                'email' => [
                    'Error',
                ],
            ],
        ], 422);
    }

    public function user()
    {
        return Auth::user();
    }
}
