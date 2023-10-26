<?php

namespace nrv\auth\api\domain\providers;


interface IProvider
{
    public function createUser(string $nom, string $prenom, string $email, string $password);
    public function verifAuthCredentials(string $login, string $password);
    public function verifAuthRefreshToken(string $refreshToken);
    public function getProfilAuth(string $username, string $email, string $refresToken);
    public function hashPassword(string $password);
}