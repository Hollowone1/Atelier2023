<?php

namespace nrv\event\api\domain\service\interfaces;

interface IArtiste
{
    public function recupArtistesByspectacle(string $idSpectacle): array;
}