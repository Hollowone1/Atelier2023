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
            $billetEntity->idSoiree = $ss->lireIdSoiree($billetDTO->idSoiree);

            return $billetEntity->toDTO();
        }
        catch (\Exception $e){
            $this->logger->error($e->getMessage());
            throw new \Exception("Erreur lors de la création du billet");
        }
    }

    public function lireBillet(string $id): billetDTO
    {
        // TODO: Implement lireBillet() method.
    }

    public function validerBillet(string $id): billetDTO
    {
        // TODO: Implement validerBillet() method.
    }
}