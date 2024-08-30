<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuthToken
{
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('All Headers:', $request->headers->all());

        // Получаем токен из заголовка Authorization, убирая возможные пробелы
        $token = trim(str_ireplace('Bearer ', '', $request->header('Authorization')));
        $validToken = config('app.auth_token');

        \Log::info('Received Token:', ['token' => $token]);
        \Log::info('Expected Token:', ['token' => $validToken]);

        // Проверка валидности токена
        if ($token !== $validToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
