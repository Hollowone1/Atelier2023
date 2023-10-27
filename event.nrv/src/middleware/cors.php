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
<<<<<<< HEAD
        $app = AppFactory::create();
=======
        $header = $request->getHeader('Origin');
        $response = $next($request, $response);

        $response = $response
            ->withHeader('Access-Control-Allow-Origin', 'http://webetu.iutnc.univ-lorraine.fr:16584/'.$header)//chercher les headers origin dans la requête
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
>>>>>>> 84b37706e29805b875080417f0ad65ea91a89925

        $app->options('/{routes:.+}', function ($request, $response, $args) {
            return $response;
        });
        
        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');
                return $response
                    ->withHeader('Access-Control-Allow-Origin', 'https://webetu.iutnc.univ-lorraine.fr/www/rionde8u/')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        });
    }
}
