<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SoireeService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederLieuSoireeAction extends AbstractAction
{

    /**
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $id = $args['idSoiree'];
        $soireeService = new SoireeService();
        $lieu = $soireeService->recupNomLieuSoiree($id);
        $response->getBody()->write(json_encode($lieu));
        return $response;
    }
}