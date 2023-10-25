<?php

namespace nrv\auth\api\domain\provider;

use nrv\auth\api\entities\User;
use pizzashop\auth\api\domain\manager\managerJWT;

class Provider implements IProvider
{
    public function __construct()
    {}

    /**
     * @param string $login
     * @param string $password
     * @return string|null
     */
    public function verifAuthCredentials(string $login, string $password)
    {
        $user = User::where('username', $login)->first();
        if ($user && password_verify($password, $user->password)) {
            return $user; // Renvoie le refresh token
        }
        return null; // Renvoie null si l'authentification échoue
    }

    public function verifAuthRefreshToken(string $refreshToken)
    {
        $user = User::where('refresh_token', $refreshToken)->first();
        if ($user && strtotime($user->refresh_token_expiration_date) > time()) {
            return true;
        }
        return false;
    }

    public function getProfilAuth(string $username, string $email, string $refreshToken)
    {
        $user = User::where('email', $email)->first();
        if ($user && $user->username === $username && $user->refresh_token === $refreshToken) {
            return [
                'username' => $user->username,
                'email' => $user->email,
                'refresh_token' => $user->refresh_token,
            ];
        }
        return null;
    }
}