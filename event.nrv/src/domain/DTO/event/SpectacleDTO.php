<?php

namespace nrv\event\api\domain\DTO\event;
use nrv\event\api\domain\DTO\DTO;

class SpectacleDTO extends DTO {

        public string $titre;
        public string $description;
        public string $urlVideo;
        public string $horaire;
        public string $image;

        public function __construct(string $titre,string $description,string $urlVideo,string $horaire, string $image)
        {
            $this->titre = $titre;
            $this->description = $description;
            $this->urlVideo = $urlVideo;
            $this->horaire = $horaire;
            $this->image = $image;
        }

        public function toArray(): array
        {
            return [
                'titre' => $this->titre,
                'description' => $this->description,
                'urlVideo' => $this->urlVideo,
                'horaire' => $this->horaire
            ];
        }

}