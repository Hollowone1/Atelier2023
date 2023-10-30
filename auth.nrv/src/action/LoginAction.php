<?php

namespace nrv\auth\api\action;

use nrv\auth\api\domain\service\AuthService;
use nrv\auth\api\domain\service\JWTManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $authHeader = $request->getHeader('Authorization');
        list($email, $password) = explode(':', base64_decode(substr($authHeader[0], 6)));

        $jwtAuthService = new JWTManager(new AuthService($this->container), new JWTManager(getenv('JWT_SECRET'), 3600));

        $result = $jwtAuthService->logIn($email, $password);
        if ($result) {
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }

        return $response->withStatus(401);
    }
}