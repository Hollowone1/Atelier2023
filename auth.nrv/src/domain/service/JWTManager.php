<?php

namespace nrv\auth\api\domain\service;

use Exception;
use Firebase\JWT\JWT;

class JWTManager
{
    private $secretKey;
    private $tokenLifeTime;

    public function __construct($secretKey, $tokenLifeTime)
    {
        $this->secretKey = $secretKey;
        $this->tokenLifeTime = $tokenLifeTime;
    }

    public function createToken($data)
    {
        $issuedAt = time();
        $expire = $issuedAt + $this->tokenLifeTime;

        $payload = array(
            'iss' => "nrv",
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => $data
        );

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function validateToken($token): ?array
    {
        try {
            $decoded = JWT::decode($token, $this->secretKey, array('HS256'));
            return (array) $decoded;
        } catch (Exception $e) {
            return null;
        }
    }

}