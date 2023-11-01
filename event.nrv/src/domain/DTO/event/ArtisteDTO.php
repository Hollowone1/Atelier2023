<?php

namespace nrv\event\api\domain\DTO\event;

use nrv\event\api\domain\DTO\DTO;

class ArtisteDTO extends DTO
{
    public string $idArtiste;
    public string $nom;
    public string $idSpectacle;

    public function __construct(string $idArtiste, string $nom, string $idSpectacle){
        $this->idArtiste = $idArtiste;
        $this->nom = $nom;
        $this->idSpectacle = $idSpectacle;
    }

    public function toArray(): array
    {
        return [
            'idArtiste' => $this->idArtiste,
            'nom' => $this->nom,
            'idSpectacle' => $this->idSpectacle,
        ];
    }
}