<?php

use App\Http\Middleware\HeaderMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->use([
            HandleCors::class,
            HeaderMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // Not Found
        $exceptions->render(function (NotFoundHttpException $e, $req) {
            if ($req->acceptsJson())
                return response()->notFound();
        });

        // Method Not Allowed
        $exceptions->render(function (MethodNotAllowedHttpException $e, $req) {
            if ($req->acceptsJson())
                return response()->methodNotAllowed();
        });

        // Access Denied
        $exceptions->render(function (AccessDeniedHttpException $e, $req) {
            if ($req->acceptsJson())
                return response()->forbidden();
        });

    })->create();