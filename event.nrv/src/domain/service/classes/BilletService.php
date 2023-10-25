<?php

namespace nrv\event\api\domain\service\classes;

use nrv\event\api\domain\DTO\billet\billetDTO;
use nrv\event\api\domain\entities\billet\Billet;
use nrv\event\api\domain\service\interfaces\IBillet;
use Ramsey\Uuid\Uuid;

class BilletService implements IBillet
{
    private UtilisateurService $us;
    private SoireeService $ss;
    private LoggerInterface $logger;

    public function __construct(UtilisateurService $us, SoireeService $ss, LoggerInterface $logger)
    {
        $this->us = $us;
        $this->ss = $ss;
        $this->logger = $logger;
    }


    public function creerBillet(billetDTO $billetDTO): billetDTO
    {
        try {
            $billetEntity = new Billet();
            $billetId = Uuid::uuid4()->toString();
            $qrCode = Uuid::uuid4()->toString();
            $billetEntity->idBillet = $billetId;
            $billetEntity->codeQR = $qrCode;
            $billetEntity->idUtilisateur = $_SESSION['idUtilisateur'];
            $billetEntity->idSoiree = $this->ss->lireIdSoiree($billetDTO->idSoiree);

            return $billetEntity->toDTO();
        }
        catch (\Exception $e){
            $this->logger->error($e->getMessage());
            throw new \Exception("Erreur lors de la création du billet");
        }
    }

    public function lireBillet(string $id): billetDTO
    {
        try {
            $billetEntity = Billet::find($id);
            if ($billetEntity == null) {
                throw new \Exception("Billet introuvable");
            }
            return $billetEntity->toDTO();
        }
        catch (\Exception $e){
            $this->logger->error($e->getMessage());
            throw new \Exception("Erreur lors de la lecture du billet");
        }
    }

    // methode pour valider un billet (verifier le nombre de billet restant avant que l'utilisateur puisse en acheter)
    public function validerBillet(string $id): billetDTO
    {
        try {
            $nbPlacesRestantes = $this->ss->lireNbPlacesRestantes($id);
            if ($nbPlacesRestantes == 0) {
                throw new \Exception("Plus de places disponibles");
            }
            $this->ss->decrementerNbPlacesRestantes($id);
            $this->logger->info("Billet validé");
            $billetEntity = Billet::find($id);
            if ($billetEntity == null) {
                throw new \Exception("Billet introuvable");
            }
            return $billetEntity->toDTO();
        }
        catch (\Exception $e){
            $this->logger->error($e->getMessage());
            throw new \Exception("Erreur lors de la validation du billet");
        }
    }
}