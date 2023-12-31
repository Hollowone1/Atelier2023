<?php

namespace nrv\auth\api\action;

use nrv\auth\api\domain\service\AuthService;
use nrv\auth\api\domain\service\JWTAuthService;
use nrv\auth\api\domain\service\JWTManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RefreshAuthAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $authHeader = $request->getHeader('Authorization');
        $refreshToken = substr($authHeader, 7);

        $jwtAuthService = new JWTAuthService(new AuthService($this->container), new JWTManager(getenv('JWT_SECRET'), 3600));
        $newTokens = $jwtAuthService->refresh($refreshToken);

        if ($newTokens) {
            $response->getBody()->write(json_encode($newTokens));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }

        return $response->withStatus(401);
    }
}