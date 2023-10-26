<?php


namespace nrv\auth\api\domain\service;

use Psr\Container\ContainerInterface;

class AuthService implements IAuthService {

    private $provider;
    private $managerJWT;

    public function __construct(ContainerInterface $container)
    {
        $this->provider = $container->get('provider');
        $this->managerJWT = $container->get('managerJWT');
    }

    /**
     * reçoit des credentials et retourne un couple (access_token, refresh_token)
     * @param $credentials
     * @return array|null
     */
    public function signin($credentials): ?array
    {
        $email = $credentials['email'];
        $password = $credentials['password'];
        $refreshToken = $this->provider->verifAuthCredentials($email, $password);

        if($refreshToken) {
            $data = [
                'nom' => $refreshToken->nom,
                'prenom' => $refreshToken->prenom,
                'email' => $refreshToken->email,
                'idUtilisateur' => $refreshToken->idUtilisateur

            ];
            $access_token = $this->managerJWT->createToken($data);
            return [
                'access_token' => $access_token,
                'refresh_token' => $refreshToken->refresh_token
            ];
        }else{
            return null;
        }
    }

    public function verifyCredentials($email, $password)
    {
        return $this->provider->verifAuthCredentials($email, $password);
    }

    public function verifyRefreshToken($refreshToken)
    {
        return $this->provider->verifAuthRefreshToken($refreshToken);
    }

    public function validate($access_token)
    {
        return $this->managerJWT->validateToken($access_token);
    }

    public function signup($credentials)
    {
        return $this->provider->createUser($credentials);
    }

    public function activate($token)
    {
        return $this->provider->activateUser($token);
    }

    public function createUser($nom, $prenom, $email, $password)
    {
        return $this->provider->createUser($nom, $prenom, $email, $password);
    }

    public function sendActivationEmail($email, $activation_token)
    {
        return $this->provider->sendActivationEmail($email, $activation_token);
    }
}