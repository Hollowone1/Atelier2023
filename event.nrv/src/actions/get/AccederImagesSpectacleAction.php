<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SpectacleService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederImagesSpectacleAction extends AbstractAction
{

    /**
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $spectacleService = new SpectacleService();
        $id = $args['idSpectacle'];
        $images = $spectacleService->recupImagesBySpectacle($id);
        $response->getBody()->write(json_encode($images));
        return $response;
    }
}