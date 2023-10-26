<?php

namespace nrv\auth\api\domain\entities;

use Illuminate\Database\Eloquent\Model;
use nrv\auth\api\domain\dto\user\UserDTO;

class User extends Model
{

    protected $connection = 'authentification';
    protected $table = 'utilisateur';
    protected $primaryKey = 'idUtilisateur';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'password',
        'dateInscription',
        'active',
        'activation_token',
        'activation_token_expiration_date',
        'refresh_token',
        'refresh_token_expiration_date',
        'reset_passwd_token',
        'reset_passwd_token_expiration_date',
        'role'
    ];

    const USER = 1;
    const ADMIN = 2;

    public function toDTO(): UserDTO
    {
        return new UserDTO(
            $this->prenom,
            $this->nom,
            $this->email,
            $this->password,
            $this->dateInscription,
            $this->active,
            $this->activation_token,
            $this->activation_token_expiration_date,
            $this->refresh_token,
            $this->refresh_token_expiration_date,
            $this->reset_passwd_token,
            $this->reset_passwd_token_expiration_date,
            $this->role);
    }
}
