<?php

namespace nrv\event\api\actions\post;

use Exception;
use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SpectacleService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DetailsSpectacle extends AbstractAction
{

    private SpectacleService $spectacleService;

    public function __invoke(Request $request, Response $response, $args): Response
    {
        try {
            $spectacle = $this->spectacleService->recupSpectacle($request->getParsedBody());
            $response->getBody()->write(json_encode($spectacle));

            $routeContext = RouteContext::fromRequest($request);
            $url = $routeContext->getRouteParser()->urlFor('accederSpectacle', ['idSpectacle' => $spectacle->getId()]);
            return $response->withHeader('Location', $url)->withStatus(201);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}