<?php

namespace nrv\auth\api\domain\dto\user;


class UserDTO {
    public string $prenom;
    public string $nom;
    public string $email;
    public string $password;
    public int $role;

    public function __construct(string $nom, string $prenom, string $email,string $password, int $role) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
}
