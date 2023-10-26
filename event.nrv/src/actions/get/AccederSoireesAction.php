<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\app\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SoireeService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederSoireesAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $soireeService = new SoireeService();
        $soirees = $soireeService->recupToutesLesSoirees();
        $response->getBody()->write(json_encode($soirees));
        return $response;
    }
}