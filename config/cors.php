<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    | Define which routes should have CORS enabled.
    | Example: ['api/*', 'sanctum/csrf-cookie'] applies CORS only to all API routes.
    */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Methods
    |--------------------------------------------------------------------------
    | List of HTTP methods allowed for cross-origin requests.
    | Use ['*'] to allow all methods.
    */
    'allowed_methods' => ['POST', 'GET', 'PUT', 'DELETE'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    | Domains that are allowed to access your API.
    | Example: ['http://localhost:3000'] → only this domain can call API.
    | Use ['*'] to allow all domains (not recommended for production).
    */
    'allowed_origins' => [env('CORS_ORIGIN', '*')],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins Patterns
    |--------------------------------------------------------------------------
    | You can define regex patterns to match allowed origins.
    | Example: ['*.example.com'] allows all subdomains of example.com.
    */
    'allowed_origins_patterns' => [],

    /*
    |--------------------------------------------------------------------------
    | Allowed Headers
    |--------------------------------------------------------------------------
    | Headers that your frontend is allowed to send with requests.
    | Example: Content-Type, Authorization, Accept
    */
    'allowed_headers' => ['Content-Type', 'Authorization', 'Accept', 'X-Custom-Header'],

    /*
    |--------------------------------------------------------------------------
    | Exposed Headers
    |--------------------------------------------------------------------------
    | Headers that should be exposed and made available to the browser.
    | Example: ['X-Custom-Header']
    */
    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | Max Age
    |--------------------------------------------------------------------------
    | How long (in seconds) the results of a preflight request can be cached.
    | Example: 3600 = 1 hour
    */
    'max_age' => 3600,

    /*
    |--------------------------------------------------------------------------
    | Supports Credentials
    |--------------------------------------------------------------------------
    | Whether cookies or authorization headers (e.g., JWT, sessions)
    | can be sent in cross-origin requests.
    | true  → allow cookies/tokens
    | false → block cookies/tokens
    */
    'supports_credentials' => true,

];