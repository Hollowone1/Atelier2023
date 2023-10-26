<?php

namespace nrv\event\api\domain\service\classes;

use nrv\event\api\domain\entities\event\Spectacle;
use nrv\event\api\domain\service\interfaces\ISoiree;
use nrv\event\api\domain\entities\event\Soiree;
use nrv\event\api\domain\entities\event\Lieu;
use nrv\event\api\domain\DTO\event\soireeDTO;
use nrv\event\api\domain\DTO\event\spectacleDTO;
use Exception;


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
        if (isset($soiree)) {
            $lieu = Lieu::where('idLieu', $soiree->idLieu)->first();
            return new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu->nom);
        } else {
            throw new Exception("Soirée non trouvée");
        }

    }

    public function supprSoiree(string $id)
    {
        $soiree = Soiree::where('idSoiree', $id)->first();
        $soiree->delete();
        //????
        throw new Exception("Soirée bien supprimée");
    }

    public function recupToutesLesSoirees(): array
    {
        $soirees = Soiree::all()->toArray();
        if (isset($soirees)) {
            return $soirees;
        } else {
            throw new Exception("Soirées non trouvées");
        }
    }

    public function recupSpectacles(string $idSoiree) : array
    {
        $allSpectacles = array();
        $spectacles = Spectacle::where('idSoiree', $idSoiree)->get()->toArray();
        if (isset($spectacles)) {
            foreach ($spectacles as $spectacle) {
                $spectacleDTO = new spectacleDTO($spectacle->titre, $spectacle->description, $spectacle->urlVideo, $spectacle->horairePrevionnel);
                $allSpectacles[] = $spectacleDTO;
            }
            return $allSpectacles;
        } else {
            throw new Exception("Spectacles non trouvés");
        }

    }

    public function filtreDate(string $date): array {
        $allSoirees = array();
        $soirees = Soiree::where('date', $date)->get()->toArray();
        if (isset($soirees)) {
            foreach ($soirees as $soiree) {
                $lieu = Lieu::where('idLieu', $soiree->idLieu)->first();
                $soireeDTO = new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu);
                $allSoirees[] = $soireeDTO;
            }
            return $allSoirees;
        } else {
            throw new Exception("Soirées non trouvées");
        }

    }
    public function filtreTheme(string $theme): array {
        $allSoirees = array();
        $soirees = Soiree::where('theme', $theme)->get()->toArray();
        if (isset($soirees)) {
            foreach ($soirees as $soiree) {
                $lieu = Lieu::where('idLieu', $soiree->idLieu)->first();
                $soireeDTO = new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu);
                $allSoirees[] = $soireeDTO;
            }
            return $allSoirees;
        } else {
            throw new Exception("Soirées non trouvées");
        }

    }
    public function filtreLieu(string $lieu): array {
        $allSoirees = array();
        $lieuNom = Lieu::where('nom', $lieu)->first();
        if (isset($lieuNom)) {
            $soirees = Soiree::where('lieu', $lieuNom)->get()->toArray();
            if (isset($soirees)) {
                foreach ($soirees as $soiree) {
                    $soireeDTO = new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieuNom);
                    $allSoirees[] = $soireeDTO;
                }
                return $allSoirees;
            } else {
                throw new Exception("Soirées non trouvées");
            }
        } else {
            throw new Exception("Lieu non trouvé");
        }

    }
}