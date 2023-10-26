<?php

namespace nrv\event\api\actions\post;

use Exception;
use nrv\event\api\actions\get\ContainerInterface;
use nrv\event\api\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreerSpectacleAction extends AbstractAction
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        try {
            $spectacleService = $this->container->get('spectacleService');
            $spectacle = $spectacleService->creerSpectacle($request->getParsedBody());
            $response->getBody()->write(json_encode($spectacle)); // peut etre mettre en to array le spectacle

            $routeContext = RouteContext::fromRequest($request);
            $url = $routeContext->getRouteParser()->urlFor('accederSpectacle', ['idSpectacle' => $spectacle->getId()]);
            return $response->withHeader('Location', $url)->withStatus(201);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}