<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\entities\event\Spectacle;
use nrv\event\api\domain\service\classes\SpectacleService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederSpectaclesSoireeAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $spectacleService = new SpectacleService();
        $spectacles = $spectacleService->recupSpectaclesBySoiree($args['idSoiree']);
        $response->getBody()->write(json_encode($spectacles));
        return $response;
    }
}