<?php

namespace nrv\auth\api\app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'auth';
    protected $table = 'users';
    protected $primaryKey = 'email';
    protected $keyType= 'string';
    public $timestamps = false;
    public $role = [1,2,3];
    protected $fillable = ['email', 'password', 'active', 'activation_token', 'activation_token_expiration_date', 'refresh_token', 'refresh_token_expiration_date', 'reset_passwd_token', 'reset_passwd_token_expiration_date', 'username'];


}