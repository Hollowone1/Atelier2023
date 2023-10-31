<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SoireeService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederImageSoireeAction extends AbstractAction
{

    /**
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $soireeService = new SoireeService();
        $soiree = $soireeService->recupImageLieu($args['idSoiree']);
        $response->getBody()->write(json_encode($soiree));
        return $response;
    }
}