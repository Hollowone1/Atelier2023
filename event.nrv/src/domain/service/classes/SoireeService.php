<?php

namespace nrv\event\api\domain\service\classes;

use nrv\event\api\domain\entities\event\Spectacle;
use nrv\event\api\domain\service\interfaces\ISoiree;
use nrv\event\api\domain\entities\event\Soiree;
use nrv\event\api\domain\entities\event\Lieu;
use nrv\event\api\domain\DTO\event\soireeDTO;
use nrv\event\api\domain\DTO\event\spectacleDTO;


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

    public function creerSoiree(SoireeDTO $soireeDTO): soireeDTO
    {
        $lieu = Lieu::where('nom', $soireeDTO->lieu)->first();
        //les id de soirées sont en autoincrement
        Soiree::updateOrCreate([
            'nom'=>$soireeDTO->nom,
            'theme' => $soireeDTO->theme,
            'dtae' => $soireeDTO->date,
            'horaireDebut' => $soireeDTO->horaire,
            'tarifNormal' => $soireeDTO->tarifNormal,
            'tarifReduit' => $soireeDTO->tarifReduit,
            'idLieu' => $lieu->idLieu
        ]);
        return $soireeDTO;
    }

    public function recupSoiree(string $id): soireeDTO
    {
        $soiree = Soiree::where('idSoiree', $id)->first();
        $lieu = Lieu::where('idLieu', $soiree->idLieu)->first();
        return new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu->nom);
    }

    public function supprSoiree(string $id): array
    {
        $soiree = Soiree::where('idSoiree', $id)->first();
        $soiree->delete();
        //return quoi ???????????????????
        // TODO: Implement supprSoiree() method.
    }

    public function recupToutesLesSoirees(): array
    {
        $soirees = Soiree::all()->toArray();
        return $soirees;
    }

    public function recupSpectacles(string $idSoiree) : array
    {
        $allSpectacles = array();
        $spectacles = Spectacle::where('idSoiree', $idSoiree)->get()->toArray();
        foreach ($spectacles as $spectacle) {
            $spectacleDTO = new spectacleDTO($spectacle->titre, $spectacle->description, $spectacle->urlVideo, $spectacle->horairePrevionnel);
            $allSpectacles[] = $spectacleDTO;
        }
        return $allSpectacles;
    }
}