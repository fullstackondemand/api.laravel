<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 201 - Created
        Response::macro('created', fn(string $message) => response()->json(['status' => true, 'message' => $message], 201));

        // 401 - Unauthorized
        Response::macro('unauthorized', fn() => response()->json(['status' => false, 'error' => 'Unauthorized request. Please login to continue.'], 401));

        // 403 - Forbidden 
        Response::macro('forbidden', fn() => response()->json(['status' => false, 'error' => 'You do not have permission to access this resource.'], 403));

        // 404 - Not Found
        Response::macro('notFound', fn() => response()->json(['status' => false, 'error' => 'The requested resource was not found.'], 404));

        // 405 - Method Not Allowed
        Response::macro('methodNotAllowed', fn() => response()->json(['status' => false, 'error' => 'The requested method is not allowed for this endpoint.'], 405));

        // 400 - Bad Request
        Response::macro('badRequest', function (string|object $error) {

            /** Response Status */
            $status = false;

            /** Form Validation Errors */
            $errors = [];

            if (!is_string($error))
                foreach ($error->toArray() as $key => $value)
                    $errors[$key] = $value[0];

            return response()->json(compact('status', is_string($error) ? 'error' : 'errors'), 400);
        });

        // 200 - Ok
        Response::macro('ok', function (string|array|object $data) {

            /** Response Status */
            $status = true;

            /** Response Message */
            $message = is_string($data) ? $data : '';

            return response()->json(compact('status', is_string($data) ? 'message' : 'data'), 200);
        });
    }
}