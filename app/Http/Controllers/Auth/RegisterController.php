<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Регистрация пользователя
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'phone' => $validated['phone'],
            'name' => $validated['name'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
        ]);
        return response()->json([
            'message' => 'Регистрация успешна',
            'user_id' => $user->id,
        ], 201);
    }
}
