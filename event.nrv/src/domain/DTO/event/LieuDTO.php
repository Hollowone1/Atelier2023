<?php

namespace nrv\event\api\domain\DTO\event;

class LieuDTO
{
    public string $idLieu;
    public string $nom;
    public string $adresse;
    public string $nbPlacesAssises;
    public string $nbPlacesDebout;


    public function __construct(string $idLieu, string $nom, string $adresse, string $nbPlacesAssises, string $nbPlacesDebout, string $idImg)
    {
        $this->idLieu = $idLieu;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->nbPlacesAssises = $nbPlacesAssises;
        $this->nbPlacesDebout = $nbPlacesDebout;
    }

    public function toArray(): array
    {
        return [
            'idLieu' => $this->idLieu,
            'nom' => $this->nom,
            'adresse' => $this->adresse,
            'nbPlacesAssises' => $this->nbPlacesAssises,
            'nbPlacesDebout' => $this->nbPlacesDebout
        ];
    }
}