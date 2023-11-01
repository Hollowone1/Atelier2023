<?php

namespace nrv\auth\api\domain\dto\panier;

use nrv\auth\api\domain\DTO\DTO;

class PanierDTO extends DTO
{

    private string $lieu;
    private string $soiree;
    private string $type;
    private string $prix;
    private string $quantite;
    

    public function __construct(string $lieu, string $soiree, string $type, float $prix, int $quantite)
    {
        $this->lieu = $lieu;
        $this->soiree = $soiree;
        $this->type = $type;
        $this->prix = $prix;
        $this->quantite = $quantite;
        
    }

    public function toArray(): array
    {
        return [
            'lieu' => $this->lieu,
            'soiree' => $this->soiree,
            'type' => $this->type,
            'prix' => $this->prix,
            'quantite' => $this->quantite,
            
        ];
    }
}
