<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BasicAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $auth = $request->header('Authorization');
        if (!$auth || !str_starts_with($auth, 'Basic ')) {
            return response()->json(['message' => 'Требуется авторизация'], 401, ['WWW-Authenticate' => 'Basic']);
        }
        $decoded = base64_decode(substr($auth, 6));
        if (!$decoded || !str_contains($decoded, ':')) {
            return response()->json(['message' => 'Неверный формат авторизации'], 401);
        }
        [$phone, $password] = explode(':', $decoded, 2);
        $user = User::where('phone', $phone)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Неверные данные'], 401);
        }
        $request->merge(['auth_user_id' => $user->id]);
        return $next($request);
    }
}
