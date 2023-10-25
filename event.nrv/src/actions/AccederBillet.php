<?php

namespace nrv\event\api\app\actions;

use Exception;
use nrv\event\api\app\actions\AbstractAction;
use nrv\event\api\domain\service\classes\BilletService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AccederBillet extends \nrv\event\api\app\actions\AbstractAction
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