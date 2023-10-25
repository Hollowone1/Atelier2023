<?php

namespace nrv\event\api\domain\DTO\soiree;
use nrv\event\api\domain\DTO;

class soireeDTO {
    public string $nom;
    public string $theme;
    public string $date;
    public string $horaire;
    public int $tarifNormal;
    public int $tarifReduit;
    public string $lieu;

    public function __construct(string $nom, string $theme, string $date, string $horaire, int $tarifNormal, int $tarifReduit, string $lieu) {
        $this->nom = $nom;
        $this->theme = $theme;
        $this->date = $date;
        $this->horaire = $horaire;
        $this->tarifNormal = $tarifNormal;
        $this->tarifReduit = $tarifReduit;
        $this->lieu = $lieu;
    }
}
