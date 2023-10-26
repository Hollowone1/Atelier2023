<?php

namespace nrv\auth\api\domain\service;

use Exception;
use Firebase\JWT\JWT;

class JWTManager
{
    private $secretKey;
    private $tokenLifeTime;
    protected $authProvider;
    protected $jwtManager;

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

    public function signIn(string $nom, string $prenom, string $password): ?array
    {
        $user = $this->authProvider->verifyCredentials($nom, $prenom, $password);
        if ($user) {
            $data = [
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email,
                'idUtilisateur' => $user->idUtilisateur
            ];
            $accessToken = $this->jwtManager->createToken($data);
            return [
                'access_token' => $accessToken,
                'refresh_token' => $user->refresh_token
            ];
        }
        return null;
    }

}