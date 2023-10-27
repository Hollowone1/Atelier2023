<?php

namespace nrv\event\api\domain\service\classes;

use nrv\event\api\domain\entities\event\ImgSpectacle;
use nrv\event\api\domain\entities\event\Spectacle;
use nrv\event\api\domain\service\interfaces\ISoiree;
use nrv\event\api\domain\entities\event\Soiree;
use nrv\event\api\domain\entities\event\Lieu;
use nrv\event\api\domain\DTO\event\SoireeDTO;
use nrv\event\api\domain\DTO\event\SpectacleDTO;
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

    public function creerSoiree(SoireeDTO $soireeDTO): SoireeDTO
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
            'idLieu' => $lieu->idLieu,
        ]);
        //TODO : trouver moyen d'ajouter des images aux soirées
        return $soireeDTO;
    }


    public function recupSoiree(string $id): soireeDTO
    {
        $soiree = Soiree::where('idSoiree', $id)->first();
        if (isset($soiree)) {
            $lieu = Lieu::where('idLieu', $soiree->idLieu)->first();
            $spectacles = Spectacle::select('idSpectacle')->where('idSoiree', $id)->get()->toArray();
            if (isset($spectacles)) {
                $images = array();
                foreach ($spectacles as $spectacle) {
                    $image = ImgSpectacle::select('img')->where('idSpectacle', $spectacle->idSpectacle)->first();
                    $images[] = $image;
                }
            }
            if (isset($images)) {
                return new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu->nom, $images);
            } else {
                return new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu->nom);
            }
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
        //????
        throw new Exception("Soirée bien supprimée");
    }

    /**
     * @throws Exception
     */
    public function recupToutesLesSoirees(): array
    {
        $listeSoirees = array();
        $soirees = Soiree::all()->toArray();
        if (isset($soirees)) {
            foreach ($soirees as $soiree) {
                $lieu = Lieu::where('idLieu', $soiree->idLieu)->first();
                $spectacle = Spectacle::where('idSoiree', $soiree->idSoiree)->first();
                $image = ImgSpectacle::select('img')->where('idSpectacle', $spectacle->idSpectacle)->first();
                if (isset($image)) {
                    $soireeDTO = new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu->nom, $image);
                    $listeSoirees[] = $soireeDTO;
                } else {
                    $soireeDTO = new soireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu->nom);
                    $listeSoirees[] = $soireeDTO;
                }
            }
            return $listeSoirees;
        } else {
            throw new Exception("Soirées non trouvées");
        }
    }

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    public function filtreDate(string $date): array {
        $allSoirees = array();
        $soirees = Soiree::where('date', $date)->get()->toArray();
        return $this->extracted($soirees, $allSoirees);

    }

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    public function boutonsTheme(): array {
        $themes = Soiree::select('theme')->get()->toArray();
        if (isset($themes)) {
            return $themes;
        } else {
            throw new Exception("Thèmes non trouvés");
        }

    }

    /**
     * @throws Exception
     */
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

    /**
     * @param $soirees
     * @param array $allSoirees
     * @return array
     * @throws Exception
     */
    public function extracted($soirees, array $allSoirees): array
    {
        if (isset($soirees)) {
            foreach ($soirees as $soiree) {
                $lieu = Lieu::where('idLieu', $soiree->idLieu)->first();
                $soireeDTO = new SoireeDTO($soiree->nom, $soiree->theme, $soiree->date, $soiree->horaireDebut, $soiree->tarifNormal, $soiree->tarifReduit, $lieu);
                $allSoirees[] = $soireeDTO;
            }
            return $allSoirees;
        } else {
            throw new Exception("Soirées non trouvées");
        }
    }

    /**
     * @throws Exception
     */
    public function boutonsLieu(): array {
        $lieux = Lieu::select('nom')->get()->toArray();
        if (isset($themes)) {
            return $lieux;
        } else {
            throw new Exception("Lieux non trouvés");
        }

    }
}