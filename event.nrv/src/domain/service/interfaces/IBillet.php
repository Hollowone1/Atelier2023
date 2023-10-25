<?php

namespace nrv\event\api\domain\service\interfaces;

use nrv\event\api\domain\DTO\billet\billetDTO;

interface IBillet
{
    // methode pour creer un billet ou cas ou l'utilisateur achète un billet
    public function creerBillet(billetDTO $billetDTO): billetDTO;
    // methode pour lire un billet
    public function lireBillet(String $id): billetDTO;
    // methode pour valider un billet (verifier le nombre de billet restant avant que l'utilisateur puisse en acheter)
    public function validerBillet(String $id): billetDTO;
}