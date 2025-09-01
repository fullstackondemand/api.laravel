<?php
namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class HeaderMiddleware
{
    public function handle($req, Closure $next): Response
    {
        return $next($req)->withHeaders([
            'X-Version' => config('app.version')
        ]);
    }
}