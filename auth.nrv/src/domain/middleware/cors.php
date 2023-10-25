<?php
namespace App\Middleware;

class CorsMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);

        // Ajoutez les en-têtes CORS ici
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', 'https://nrv.net')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withHeader('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
