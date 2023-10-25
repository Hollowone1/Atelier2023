<?php

namespace nrv\event\api\domain\service\classes;

use nrv\event\api\domain\entities\event\Spectacle;
use nrv\event\api\domain\service\interfaces\ISoiree;

class SoireeService implements ISoiree
{
    private BilletService $bs;
    private LieuService $ls;
    private SpectacleService $ss;
    private LoggerInterface $logger;

    public function __construct(BilletService $bs, Spectacle $ss, LieuService $ls, LoggerInterface $logger)
    {
        $this->bs = $bs;
        $this->ss = $ss;
        $this->ls = $ls;
        $this->logger = $logger;
    }

    public function creerSoiree(string $nom, string $theme, string $date, string $horaire, int $tarifNormal, int $tarifReduit, string $lieu): array
    {
        // TODO: Implement creerSoiree() method.
    }

    public function recupSoiree(string $id): array
    {
        // TODO: Implement recupSoiree() method.
    }

    public function supprSoiree(string $id): array
    {
        // TODO: Implement supprSoiree() method.
    }

    public function recupToutesLesSoirees(): array
    {
        // TODO: Implement recupToutesLesSoirees() method.
    }
}