<?php


namespace nrv\auth\api\domain\service;

interface IAuthService
{
    public function signin($credentials);

    public function verifyCredentials($email, $password);

    public function verifyRefreshToken($refreshToken);

    public function validate($access_token);

    public function signup($credentials);

    public function activate($token);

    public function createUser($nom, $prenom, $email, $password);

    public function sendActivationEmail($email, $activation_token);
}