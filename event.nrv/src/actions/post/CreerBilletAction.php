<?php

namespace nrv\event\api\actions\post;

use Exception;
use nrv\event\api\actions\AbstractAction;
use nrv\event\api\domain\DTO\billet\BilletDTO;
use nrv\event\api\domain\service\classes\BilletService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreerBilletAction extends AbstractAction
{
    private BilletService $bs;

    public function __construct(ContainerInterface $container, BilletService $bs)
    {
        parent::__construct($container);
        $this->bs = $bs;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        try {
            $body = $request->getParsedBody();
            $billetId = Uuid::uuid4()->toString();
            $billetDTO = new BilletDTO($billetId, $body['codeQR'], $body['idUtilisateur'], $body['idSoiree']);
            $billet = $this->bs->creerBillet($billetDTO);
            $response->getBody()->write(json_encode($billet->toArray()));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}