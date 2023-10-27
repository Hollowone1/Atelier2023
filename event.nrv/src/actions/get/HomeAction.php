<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;
use Slim\Routing\RouteContext;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeAction extends AbstractAction
{
//    public function __construct(ContainerInterface $container)
//    {
//        parent::__construct($container);
//    }

    public function __invoke(Request $request, Response $response, $args) : Response
    {
        $response->getBody()->write("Welcome to the NRV.net API !");
        return $response;
    }
}