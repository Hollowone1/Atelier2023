<?php

namespace nrv\event\api\app\actions;

use nrv\event\api\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederLieuAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $id = $args['id'];
        $spectacleService = $this->container->get('spectacleService');
        $lieu = $spectacleService->recupLieu($id);
        $response->getBody()->write(json_encode($lieu->toArray()));
        return $response;
    }
}

