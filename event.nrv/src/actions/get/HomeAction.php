<?php

namespace nrv\event\api\actions\get;

use Slim\Routing\RouteContext;

class HomeAction
{
    public function __invoke($request, $response, $args)
    {
        $response->getBody()->write("Welcome to the NRV.net API !");
        return $response;
    }
}