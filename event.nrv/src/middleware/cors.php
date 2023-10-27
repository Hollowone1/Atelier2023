<?php
namespace nrv\event\api\middleware;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;


class CorsMiddleware
{
    public function __invoke(Request $request, Response $response)
    {
        $app = AppFactory::create();

        $app->options('/{routes:.+}', function ($request, $response, $args) {
            return $response;
        });
        
        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');
                return $response
                    ->withHeader('Access-Control-Allow-Origin', '*')
                    //->withHeader('Access-Control-Allow-Origin', 'https://webetu.iutnc.univ-lorraine.fr/www/rionde8u/nrv.web/')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Credentials', 'true');
        });
    }
}
