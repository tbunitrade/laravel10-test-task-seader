<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuthToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $validToken = env('AUTH_TOKEN');


        \Log::info('Received Token:', ['token' => $token]);
        \Log::info('Expected Token:', ['token' => $validToken]);

        if ($token !== $validToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
