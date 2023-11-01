<?php

namespace nrv\event\api\domain\service\classes;

use nrv\event\api\domain\entities\event\Artiste;
use nrv\event\api\domain\service\interfaces\IArtiste;

class ArtisteService implements IArtiste
{

    public function recupArtistesByspectacle(string $idSpectacle): array
    {
        $artistesEntities = Artiste::where('idSpectacle', $idSpectacle)->get();
        $artistesDTO = [];
        foreach ($artistesEntities as $artistesEntity) {
            $artiste = new Artiste();
            $artiste->idArtiste = $artistesEntity->idArtiste;
            $artiste->nom = $artistesEntity->nom;
            $artiste->idSpectacle = $artistesEntity->idSpectacle;
            $artistesDTO[] = $artiste->toDTO();
        }
        return $artistesDTO;
    }
}