<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HeaderMiddleware
{
    public function handle(Request $req, Closure $next): JsonResponse
    {
        return $next($req)->withHeaders([
            'X-Version' => config('app.version')
        ]);
    }
}