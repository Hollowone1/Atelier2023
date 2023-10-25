<?php

namespace nrv\event\api\domain\service\interfaces;

interface ISoiree
{
    public function creerSoiree(string $nom, string $theme, string $date, string $horaire, int $tarifNormal, int $tarifReduit, string $lieu): array;
    public function recupSoiree(string $id): array;
    public function supprSoiree(string $id): array;
    public function recupToutesLesSoirees(): array;
}