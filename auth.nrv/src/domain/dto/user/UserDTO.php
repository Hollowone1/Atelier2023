<?php

namespace nrv\auth\api\domain\dto\user;


class UserDTO {
    public string $prenom;
    public string $nom;
    public string $email;
    public string $password;
    public int $role;
    public $timestamps = false;
    protected $fillable = ['password',
        'actve',
        'activation_token',
        'activation_token_expiration_date',
        'refresh_token',
        'refresh_token_expiration_date',
        'reset_passwd_token',
        'reset_passwd_token_expiration_date',
        'username'];

    public function __construct(string $nom, string $prenom, string $email,string $password, int $role, array $fillable) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->fillable = $fillable;
       
    }
}
