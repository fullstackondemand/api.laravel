<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // Not Found
        $exceptions->render(function (NotFoundHttpException $e, $req) {
            if ($req->acceptsJson())
                return response()->json(['status' => false, 'error' => 'The requested resource was not found.'], 404);
        });

        // Method Not Allowed
        $exceptions->render(function (MethodNotAllowedHttpException $e, $req) {
            if ($req->acceptsJson())
                return response()->json(['status' => false, 'error' => 'The requested method is not allowed for this endpoint.'], 405);
        });

        // Access Denied
        $exceptions->render(function (AccessDeniedHttpException $e, $req) {
            if ($req->acceptsJson())
                return response()->json(['status' => false, 'error' => 'Unauthorized request. Please login to continue.'], 403);
        });

    })->create();