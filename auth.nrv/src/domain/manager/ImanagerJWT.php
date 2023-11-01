<?php

namespace nrv\auth\api\domain\manager;
interface IManagerJWT
{

    public function createToken($data);

    public function validateToken($token);
}