<?php

namespace nrv\auth\api\domain\service;

interface IJWTAuthService
{
    public function signIn($username, $password);

    public function validate($accessToken);

    public function refresh($refreshToken);

    public function signup($nom, $prenom, $email, $password);

    public function activate($refreshToken);
}