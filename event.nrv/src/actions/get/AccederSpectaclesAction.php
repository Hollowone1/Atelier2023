<?php

namespace nrv\event\api\actions\get;

use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SpectacleService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederSpectaclesAction extends AbstractAction
{
//    public function __construct(ContainerInterface $container)
//    {
//        parent::__construct($container);
//    }


    public function __invoke(Request $request, Response $response, $args): Response
    {
//        $spectacleService = $this->container->get('spectacleService');
        $spectacleService = new SpectacleService();
        $spectacles = $spectacleService->recupTousLesSpectacles();
        $response->getBody()->write(json_encode($spectacles));
        return $response;
    }
}