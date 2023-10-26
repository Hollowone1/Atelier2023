<?php

namespace nrv\event\api\domain\service\interfaces;
use nrv\event\api\domain\DTO\event\soireeDTO;


interface ISoiree
{
    public function creerSoiree(SoireeDTO $soireeDTO): SoireeDTO;
    public function recupSoiree(string $id): SoireeDTO;
    public function supprSoiree(string $id);
    public function recupToutesLesSoirees(): array;
    public function recupSpectacles(string $idSoiree) : array;
    public function filtreTheme(string $theme): array;
    public function filtreDate(string $date): array;
    public function filtreLieu(string $lieu): array;
}