<?php

namespace nrv\event\api\domain\DTO\event;
use nrv\event\api\domain\DTO;

class spectacleDTO extends DTO {

        public string $titre;
        public string $description;
        public string $urlVideo;
        public string $horaire;

        public function __construct(string $titre,string $description,string $urlVideo,string $horaire)
        {
            $this->titre = $titre;
            $this->description = $description;
            $this->urlVideo = $urlVideo;
            $this->horaire = $horaire;
        }

}