<?php

namespace nrv\event\api\domain\DTO\event;
use nrv\event\api\domain\DTO\DTO;

class SoireeDTO extends DTO {
    public string $idSoiree;
    public string $nom;
    public string $theme;
    public string $date;
    public string $horaire;
    public float $tarifNormal;
    public float $tarifReduit;
    public string $idLieu;

    public function __construct(string $idSoiree, string $nom, string $theme, string $date, string $horaire, float $tarifNormal, float $tarifReduit, string $idLieu) {
        $this->idSoiree = $idSoiree;
        $this->nom = $nom;
        $this->theme = $theme;
        $this->date = $date;
        $this->horaire = $horaire;
        $this->tarifNormal = $tarifNormal;
        $this->tarifReduit = $tarifReduit;
        $this->idLieu = $idLieu;
    }

    public function toArray(): array
    {
        return [
            'idSoiree' => $this->idSoiree,
            'nom' => $this->nom,
            'theme' => $this->theme,
            'date' => $this->date,
            'horaire' => $this->horaire,
            'tarifNormal' => $this->tarifNormal,
            'tarifReduit' => $this->tarifReduit,
            'idLieu' => $this->idLieu
        ];
    }
}
