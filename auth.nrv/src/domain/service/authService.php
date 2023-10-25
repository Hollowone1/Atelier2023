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

    public function signin($credentials){

    }

    public function validate($access_token){

    }

    public function refresh($refresh_token){

    }

    public function signup($credentials){

    }

    public function activate($token){

    }
}