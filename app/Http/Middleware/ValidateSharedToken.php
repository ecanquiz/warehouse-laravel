<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateSharedToken
{
    public function handle(Request $request, Closure $next)
    {
        $sharedToken = config('api.app.shared_token'); // Shared token in .env

        $token = $request->header('Authorization');

        if (!$token || !preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($matches[1] !== $sharedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
