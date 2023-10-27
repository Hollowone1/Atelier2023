<?php

namespace nrv\event\api\app\actions;

use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SpectacleService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederLieuAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $lieuService = new LieuService();
        $lieu = $lieuService->recupLieu($args['idLieu']);
        $response->getBody()->write(json_encode($lieu));
        return $response;
    }
}

