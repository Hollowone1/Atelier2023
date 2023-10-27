<?php

namespace nrv\event\api\domain\DTO\event;
use nrv\event\api\domain\DTO\DTO;

class SoireeDTO extends DTO {
    public string $nom;
    public string $theme;
    public string $date;
    public string $horaire;
    public int $tarifNormal;
    public int $tarifReduit;
    public string $lieu;
    public array $images;
    public array $spectacles;


    public function __construct(string $nom, string $theme, string $date, string $horaire, int $tarifNormal, int $tarifReduit, string $lieu, ?array $images = null, ?array $spectacles = null) {
        $this->nom = $nom;
        $this->theme = $theme;
        $this->date = $date;
        $this->horaire = $horaire;
        $this->tarifNormal = $tarifNormal;
        $this->tarifReduit = $tarifReduit;
        $this->lieu = $lieu;
        $this->images = $images;
        $this->spectacles = $spectacles;
    }

    public function toArray(): array
    {
        return [
            'nom' => $this->nom,
            'theme' => $this->theme,
            'date' => $this->date,
            'horaire' => $this->horaire,
            'tarifNormal' => $this->tarifNormal,
            'tarifReduit' => $this->tarifReduit,
            'lieu' => $this->lieu
        ];
    }
}
