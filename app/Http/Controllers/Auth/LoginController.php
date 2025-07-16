<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /**
     * Авторизация пользователя
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('phone', $validated['phone'])->first();
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['error' => 'Неверные данные'], 401);
        }

        // Basic Auth: возвращаем base64-токен
        $token = base64_encode($user->phone . ':' . $validated['password']);
        return response()->json([
            'message' => 'Успешный вход',
            'token' => $token,
            'user_id' => $user->id,
        ], 200);
    }
}
