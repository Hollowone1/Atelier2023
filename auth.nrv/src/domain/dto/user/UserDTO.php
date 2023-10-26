<?php

namespace nrv\auth\api\domain\dto\user;


class UserDTO
{

    private string $prenom;
    private string $nom;
    private string $email;
    private string $password;
    private string $dateInscription;
    private int $active;
    private string $activation_token;
    private string $activation_token_expiration_date;
    private string $refresh_token;
    private string $refresh_token_expiration_date;
    private string $reset_passwd_token;
    private string $reset_passwd_token_expiration_date;
    private int $role;

    public function __construct(string $prenom, string $nom, string $email, string $password, string $dateInscription, int $active, string $activation_token, string $activation_token_expiration_date, string $refresh_token, string $refresh_token_expiration_date, string $reset_passwd_token, string $reset_passwd_token_expiration_date, int $role)
    {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->dateInscription = $dateInscription;
        $this->active = $active;
        $this->activation_token = $activation_token;
        $this->activation_token_expiration_date = $activation_token_expiration_date;
        $this->refresh_token = $refresh_token;
        $this->refresh_token_expiration_date = $refresh_token_expiration_date;
        $this->reset_passwd_token = $reset_passwd_token;
        $this->reset_passwd_token_expiration_date = $reset_passwd_token_expiration_date;
        $this->role = $role;
    }

    public function toArray(): array
    {
        return [
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'email' => $this->email,
            'password' => $this->password,
            'dateInscription' => $this->dateInscription,
            'active' => $this->active,
            'activation_token' => $this->activation_token,
            'activation_token_expiration_date' => $this->activation_token_expiration_date,
            'refresh_token' => $this->refresh_token,
            'refresh_token_expiration_date' => $this->refresh_token_expiration_date,
            'reset_passwd_token' => $this->reset_passwd_token,
            'reset_passwd_token_expiration_date' => $this->reset_passwd_token_expiration_date,
            'role' => $this->role
        ];
    }
}
