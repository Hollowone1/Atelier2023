<?php

namespace nrv\event\api\domain\service\interfaces;

use nrv\event\api\domain\DTO\event\spectacleDTO;

interface ISpectacle
{
    public function creerSpectacle(SpectacleDTO $spectacleDTO): SpectacleDTO;
    public function recupSpectacle(string $id): SpectacleDTO;
    public function supprSpectacle(string $id): array;
    public function recupTousLesSpectacles(): array;
}