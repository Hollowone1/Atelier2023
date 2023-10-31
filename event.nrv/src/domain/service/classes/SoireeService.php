<?php

namespace nrv\event\api\domain\service\classes;

use nrv\event\api\domain\entities\event\Spectacle;
use nrv\event\api\domain\service\interfaces\ISoiree;
use nrv\event\api\domain\entities\event\Soiree;
use nrv\event\api\domain\entities\event\Lieu;
use nrv\event\api\domain\DTO\event\SoireeDTO;
use nrv\event\api\domain\DTO\event\SpectacleDTO;
use Exception;


class SoireeService implements ISoiree
{

    public function creerSoiree(SoireeDTO $soireeDTO): SoireeDTO
    {
        $lieu = Lieu::where('idLieu', $soireeDTO->idLieu)->first();
        //les id de soirées sont en autoincrement
        Soiree::updateOrCreate([
            'nom' => $soireeDTO->nom,
            'theme' => $soireeDTO->theme,
            'dtae' => $soireeDTO->date,
            'horaireDebut' => $soireeDTO->horaire,
            'tarifNormal' => $soireeDTO->tarifNormal,
            'tarifReduit' => $soireeDTO->tarifReduit,
            'idLieu' => $lieu->idLieu,
        ]);
        return $soireeDTO;
    }

    public function recupImageLieu(string $id): string
    {
        $lieu = Lieu::where('idLieu', $id)->first();
        if (isset($lieu)) {
            return $lieu->image;
        } else {
            throw new Exception("Lieu non trouvé");
        }
    }

    /**
     * @throws Exception
     */
    public function recupSoiree(string $id): SoireeDTO
    {
        $soiree = Soiree::where('idSoiree', $id)->first();
        if (isset($soiree)) {
            return new SoireeDTO($soiree->idSoiree, $soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $soiree->idLieu);
        } else {
            throw new Exception("Soirée non trouvée");
        }
    }

    /**
     * @throws Exception
     */
    public function supprSoiree(string $id)
    {
        $soiree = Soiree::where('idSoiree', $id)->first();
        $soiree->delete();
    }

    public function recupToutesLesSoirees(): array
    {
        return Soiree::all()->toArray();
    }

    /**
     * @throws Exception
     */
    public function recupSpectacles(string $idSoiree): array
    {
        $spectacles = Spectacle::where('idSoiree', $idSoiree)->get()->toArray();
        $spectaclesDTO = [];
        if (isset($spectacles)) {
            foreach ($spectacles as $spectacle) {
                $spectaclesDTO[] = new SpectacleDTO($spectacle->idSpectacle, $spectacle->titre,  $spectacle->description, $spectacle->urlVideo,  $spectacle->horairePrevionnel, $spectacle->idSoiree);
            }
            return $spectaclesDTO;
        } else {
            throw new Exception("Spectacles non trouvés");
        }
    }

    /**
     * @throws Exception
     */
    public function filtreDate(string $date): array
    {
        $listeSoireesDate = array();
        $soirees = Soiree::where('date', $date)->get()->toArray();
        if (isset($soirees)) {
            foreach ($soirees as $soiree) {
                $listeSoireesDate = $this->getArr($soiree, $listeSoireesDate);
            }
            return $listeSoireesDate;
        } else {
            throw new Exception("Soirées non trouvées");
        }
    }

    /**
     * @throws Exception
     */
    public function filtreTheme(string $theme): array
    {
        $listeSoireesTheme = array();
        $soirees = Soiree::where('theme', $theme)->get()->toArray();
        if (isset($soirees)) {
            foreach ($soirees as $soiree) {
                $listeSoireesTheme = $this->getArr($soiree, $listeSoireesTheme);
            }
            return $listeSoireesTheme;
        } else {
            throw new Exception("Soirées non trouvées");
        }
    }

    /**
     * @throws Exception
     */
    public function filtreLieu(string $lieu): array
    {
        $allSoirees = array();
        $lieuNom = Lieu::where('nom', $lieu)->first();
        if (isset($lieuNom)) {
            $soirees = Soiree::where('lieu', $lieuNom)->get()->toArray();
            if (isset($soirees)) {
                foreach ($soirees as $soiree) {
                    $allSoirees = $this->getArr($soiree, $allSoirees);
                }
                return $allSoirees;
            } else {
                throw new Exception("Soirées non trouvées");
            }
        } else {
            throw new Exception("Lieu non trouvé");
        }
    }

    /**
     * @param $soiree
     * @param array $allSoirees
     * @return array
     */
    public function getArr($soiree, array $allSoirees): array
    {
        $soireeDTO = new soireeDTO($soiree->idSoiree, $soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $soiree->idLieu);
        $allSoirees[] = $soireeDTO;
        return $allSoirees;
    }

}