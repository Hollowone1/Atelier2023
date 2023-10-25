<?php

namespace nrv\event\api\domain\DTO\billet;
use nrv\event\api\domain\DTO;

class BilletDTO extends DTO {
    
    public int $idBillet;
    public string $codeQR;
    public string $idUtilisateur;
    public string $idSoiree;

    public function __construct(string $idBillet, string $codeQR, string $idUtilisateur, string $idSoiree)
    {
        $this->idBillet = $idBillet;
        $this->codeQR = $codeQR;
        $this->idUtilisateur = $idUtilisateur;
        $this->idSoiree = $idSoiree;
    }

    public function toArray() {
        return [
            'idBillet' => $this->idBillet,
            'codeQR' => $this->codeQR,
            'idUtilisateur' => $this->idUtilisateur,
            'idSoiree' => $this->idSoiree
        ];
    }
}