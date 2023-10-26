<?php
namespace nrv\event\api\middleware;

class CorsMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);

        $response = $response
            ->withHeader('Access-Control-Allow-Origin', 'http://docketu.iutnc.univ-lorraine.fr:16584/')//chercher les headers origin dans la requête
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withHeader('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
