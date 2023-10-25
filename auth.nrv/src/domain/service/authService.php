<?php


namespace nrv\auth\api\domain\service;

use Psr\Container\ContainerInterface;

class ServiceAuth implements IServiceAuth{

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
     * @return array
     */

    public function signin($credentials){
        $username = $credentials['username'];
        $password = $credentials['password'];
        $refreshToken = $this->provider->verifAuthCredentials($username, $password);

        if($refreshToken) {
            $data = [
                'username' => $refreshToken->username,
                'email' => $refreshToken->email,
                'id' => $refreshToken->id

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

    /**
     * reçoit un access_token et vérifie sa validité, puis retourne le profil de l'utilisateur
     * authentifié
     * @param $access_token
     * @return UserDTO
     */

    public function validate($access_token){

    }

    public function refresh($refresh_token){

    }

    public function signup($credentials){

    }

    public function activate($token){

    }
}