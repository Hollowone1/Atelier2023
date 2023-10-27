<?php

namespace nrv\event\api\domain\DTO\event;

use Cassandra\Date;
use nrv\event\api\domain\DTO\DTO;

class SpectacleDTO extends DTO {

        public string $idSpectacle;
        public string $titre;
        public string $description;
        public string $urlVideo;
        public string $horairePrevionnel;
        public string $idSoiree;
        //public int $idImg;

        public function __construct(string $idSpectacle, string $titre,string $description,string $urlVideo,string $horairePrevionnel, string $idSoiree)
        {
            $this->idSpectacle = $idSpectacle;
            $this->titre = $titre;
            $this->description = $description;
            $this->urlVideo = $urlVideo;
            $this->horairePrevionnel = $horairePrevionnel;
            $this->idSoiree = $idSoiree;
        }

        public function toArray(): array
        {
            return [
                'idSpectacle' => $this->idSpectacle,
                'titre' => $this->titre,
                'description' => $this->description,
                'urlVideo' => $this->urlVideo,
                'horairePrevionnel' => $this->horairePrevionnel,
                'idSoiree' => $this->idSoiree
                //'idImg' => $this->idImg,
            ];
        }

}