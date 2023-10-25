<?php

namespace nrv\auth\api\domain\providers;


interface IProvider
{

    public function verifAuthCredentials(string $login, string $password);

    public function verifAuthRefreshToken(string $refreshToken);
    public function getProfilAuth(string $username, string $email, string $refresToken);


}