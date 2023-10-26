<?php

namespace nrv\auth\api\domain\service;

class JWTAuthService implements IJWTAuthService
{
    private AuthService $authProvider;
    private JWTManager $jwtManager;

    public function __construct($authProvider, $jwtManager) {
        $this->authProvider = $authProvider;
        $this->jwtManager = $jwtManager;
    }

    public function signIn($username, $password): ?array
    {
        $user = $this->authProvider->verifyCredentials($username, $password);
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

    public function validate($accessToken) {
        $decodedToken = $this->jwtManager->validateToken($accessToken);
        if ($decodedToken && isset($decodedToken['upr'])) {
            return $decodedToken['upr'];
        }
        return null;
    }

    public function refresh($refreshToken): ?array
    {
        $user = $this->authProvider->verifyRefreshToken($refreshToken);
        if ($user) {
            return $this->signIn($user->username, $user->password);
        }
        return null;
    }

    public function signup($nom, $prenom, $email, $password): void
    {
        $user = $this->authProvider->createUser($nom, $prenom, $email, $password);
        if ($user) {
            $data = [
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email,
                'idUtilisateur' => $user->idUtilisateur
            ];
            $accessToken = $this->jwtManager->createToken($data);
            $this->authProvider->sendActivationEmail($email, $user->activation_token);
        }
    }

    public function activate($refreshToken): void
    {
        $user = $this->authProvider->verifyRefreshToken($refreshToken);
        if ($user) {
            $this->authProvider->activate($user->idUtilisateur);
        }
    }
}