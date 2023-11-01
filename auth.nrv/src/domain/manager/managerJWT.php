<?php

namespace nrv\auth\api\domain\manager;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;



class managerJWT implements IManagerJWT
{


    public function createToken($data)
    {
//        $entete= [
//                "alg" => "HS512", // hashing
//                "typ" => "JWT" // type
//            ];

        $payload=[
                "iss" => "http://docketu.iutnc.univ-lorraine.fr:16584/", // issuer, émetteur du token
                "sub" => "nrv_event.db", // Subject
                "aud" => "nrv_auth-api.auth-1",//audience, utilisateur du token
                "iat" => time(), // Heure d'émission
                "exp" => time() + 3600, // Heure d'expiration
                'username' => $data['username'],
            ];

        return JWT::encode($payload, 'secret', 'HS256');

    }

    public function validateToken($token)
    {
        $tokenDecode = JWT::decode($token, new Key( 'secret', 'HS256'));
        $tokenDecodeArray = (array)$tokenDecode;
        if($tokenDecodeArray){
            return $tokenDecodeArray['username'];
        }else{
            return false;
        }
    }
        
           
    }