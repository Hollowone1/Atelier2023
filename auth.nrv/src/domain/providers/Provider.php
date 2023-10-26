<?php

namespace nrv\auth\api\domain\providers;

use nrv\auth\api\domain\entities\User;
use nrv\auth\api\domain\service\JWTManager;
use pizzashop\auth\api\domain\manager\managerJWT;

class Provider implements IProvider
{
    private JWTManager $jWTManager;

    public function __construct()
    {
        $this->jWTManager = new JWTManager(
            $_ENV['JWT_SECRET_KEY'],
            $_ENV['JWT_TOKEN_LIFETIME']
        );
    }

    public function createUser(string $nom, string $prenom, string $email, string $password): User
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $user = new User();
        $user->nom = $nom;
        $user->prenom = $prenom;
        $user->email = $email;
        $user->password = $passwordHash;
        $user->refresh_token = null;
        $user->save();

        return $user;
    }

    /**
     * @param string $login
     * @param string $password
     * @return string|null
     */
    public function verifAuthCredentials(string $login, string $password): ?string
    {
        $user = User::where('username', $login)->first();
        if ($user && password_verify($password, $user->password)) {
            return $user; // Renvoie le refresh token
        }
        return null; // Renvoie null si l'authentification échoue
    }

    public function verifAuthRefreshToken(string $refreshToken): bool
    {
        $user = User::where('refresh_token', $refreshToken)->first();
        if ($user && strtotime($user->refresh_token_expiration_date) > time()) {
            return true;
        }
        return false;
    }

    public function getProfilAuth(string $username, string $email, string $refreshToken): ?array
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

    public function hashPassword(string $password): string
    {
        return hash('sha256', $password);
    }

}