<?php

namespace nrv\auth\api\action;

use nrv\auth\api\domain\service\AuthService;
use nrv\auth\api\domain\service\JWTAuthService;
use nrv\auth\api\domain\service\JWTManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ValidateTokenAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $authHeader = $request->getHeader('Authorization');
        $accessToken = substr($authHeader, 7);

        $jwtAuthService = new JWTAuthService(new AuthService($this->container), new JWTManager(getenv('JWT_SECRET_KEY'), 3600));
        $userProfile = $jwtAuthService->validate($accessToken);

        if ($userProfile) {
            $response->getBody()->write(json_encode($userProfile));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }

        return $response->withJson(['error' => 'Invalid or expired token'], 401);
    }
}