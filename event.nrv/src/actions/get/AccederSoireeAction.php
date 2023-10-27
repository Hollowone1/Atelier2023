<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;

use nrv\event\api\domain\service\classes\SoireeService;
use nrv\event\api\domain\service\classes\SpectacleService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederSoireeAction extends AbstractAction {

    /**
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $id = $args['idSoiree'];
//        $spectacleService = $this->container->get('spectacleService');
        $soireeService = new SoireeService();
        $soiree = $soireeService->recupSoiree($id);
        $response->getBody()->write(json_encode($soiree));
        return $response;
    }
}