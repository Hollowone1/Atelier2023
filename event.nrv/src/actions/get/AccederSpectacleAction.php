<?php

namespace nrv\event\api\actions\get;


use Exception;
use nrv\event\api\app\actions\AbstractAction;
use nrv\event\api\domain\service\classes\SpectacleService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederSpectacleAction extends AbstractAction
{
//    public function __construct(ContainerInterface $container)
//    {
//        parent::__construct($container);
//    }

    /**
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, $args) : Response
    {
        $id = $args['idSpectacle'];
//        $spectacleService = $this->container->get('spectacleService');
        $spectacleService = new SpectacleService();
        $soiree = $spectacleService->recupSpectacle($id);
        $response->getBody()->write(json_encode($soiree->toArray()));
        return $response;
    }
}