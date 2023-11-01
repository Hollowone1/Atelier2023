<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\service\classes\ArtisteService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederArtistesSpectacleAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $idSpectacle = $args['idSpectacle'];
        $artisteService = new ArtisteService();
        $artistes = $artisteService->recupArtistesByspectacle($idSpectacle);
        $response->getBody()->write(json_encode($artistes));
        return $response;
    }
}