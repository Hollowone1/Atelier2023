<?php

namespace nrv\event\api\actions;

use Exception;
use nrv\event\api\app\actions\AbstractAction;
use nrv\event\api\domain\service\classes\BilletService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccederBilletAction extends AbstractAction
{
    private BilletService $bs;

    public function __construct(BilletService $bs)
    {
        $this->bs = $bs;
    }

    public function __invoke(Request $request, Response $response, $args) : Response
    {
        try {
            $billet = $this->bs->lireBillet($args['idBillet']);

            $links = array(
                "self" => array(
                    "href" => "/billets/" . $args['idBillet'] . "/"
                ),
                "valider" => array(
                    "href" => "/billets/" . $args['idBillet']
                )
            );

            $billet = $billet->toArray() + $links;
            $order_json = json_encode($billet);
            $response->getBody()->write($order_json);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);

        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }
}