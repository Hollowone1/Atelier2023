<?php

namespace nrv\event\api\actions\post;

use Exception;
use nrv\event\api\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreerSoireeAction extends AbstractAction
{

    private SoireeService $soireeService;

    public function __construct(ContainerInterface $container, SoireeService $soireeService)
    {
        parent::__construct($container);
        $this->soireeService = $soireeService;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        try {
            $soiree = $this->soireeService->creerSoiree($request->getParsedBody());
            $response->getBody()->write(json_encode($soiree));

            $routeContext = RouteContext::fromRequest($request);
            $url = $routeContext->getRouteParser()->urlFor('accederSoiree', ['idSoiree' => $soiree->getId()]);
            return $response->withHeader('Location', $url)->withStatus(201);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}