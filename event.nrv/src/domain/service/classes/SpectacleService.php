<?php

namespace nrv\event\api\domain\service\classes;

use Exception;
use http\Params;
use nrv\event\api\domain\DTO\event\SpectacleDTO;
use nrv\event\api\domain\entities\event\ImgSpectacle;
use nrv\event\api\domain\entities\event\Spectacle;
use nrv\event\api\domain\service\interfaces\ISpectacle;

class SpectacleService implements ISpectacle
{

    public function creerSpectacle(SpectacleDTO $spectacleDTO): SpectacleDTO
    {
        $spectacleEntity = new Spectacle();
        $spectacleId = Uuid::uuid4()->toString();
        $spectacleEntity->idSpectacle = $spectacleId;
        $spectacleEntity->titre = $spectacleDTO->titre;
        $spectacleEntity->description = $spectacleDTO->description;
        $spectacleEntity->urlVideo = $spectacleDTO->urlVideo;
        $spectacleEntity->horairePrevionnel = $spectacleDTO->horairePrevionnel;
        $spectacleEntity->idSoiree = $spectacleDTO->idSoiree;
        $spectacleEntity->idImg = $spectacleDTO->idImg;
        return new SpectacleDTO($spectacleEntity->idSpectacle, $spectacleEntity->titre, $spectacleEntity->description, $spectacleEntity->urlVideo, $spectacleEntity->horairePrevionnel, $spectacleEntity->idSoiree, $spectacleEntity->idImg);
    }

    /**
     * @throws Exception
     */
    public function recupSpectacle(string $id): SpectacleDTO
    {
        $billetEntity = Spectacle::find($id);
        if ($billetEntity == null) {
            throw new Exception("Spectacle introuvable");
        }
        return $billetEntity->toDTO();
    }

    /**
     * @throws Exception
     */
    public function supprSpectacle(string $id): array
    {
        $billetEntity = $this->recupSpectacle($id);
        $billetEntity->delete();
        return ["message" => "Spectacle supprimé"];
    }

    public function recupTousLesSpectacles(): array
    {
        $spectacleEntities = Spectacle::all();
        $spectacleDTOs = [];
        foreach ($spectacleEntities as $spectacleEntity) {
            $spectacle = new Spectacle();
            $spectacle->idSpectacle = $spectacleEntity->idSpectacle;
            $spectacle->titre = $spectacleEntity->titre;
            $spectacle->description = $spectacleEntity->description;
            $spectacle->urlVideo = $spectacleEntity->urlVideo;
            $spectacle->horairePrevionnel = $spectacleEntity->horairePrevionnel;
            $spectacle->idSoiree = $spectacleEntity->idSoiree;
            //$spectacle->idImg = $spectacleEntity->idImg;
            $spectacleDTOs[] = $spectacle->toDTO();

        }
        return $spectacleDTOs;
    }

    // créer une fonction qui permet de récupérer tous les spectacles d'une soirée
    public function recupSpectaclesBySoiree(string $idSoiree) : array {
        // $spectacles = Spectacle::whereIn('idSoiree', $idSoiree)->get();

        $spectaclesEntities = Spectacle::where('idSoiree', $idSoiree)->get();
        $spectacleDTOs = [];
        foreach ($spectaclesEntities as $spectacleEntity) {
            $spectacle = new Spectacle();
            $spectacle->idSpectacle = $spectacleEntity->idSpectacle;
            $spectacle->titre = $spectacleEntity->titre;
            $spectacle->description = $spectacleEntity->description;
            $spectacle->urlVideo = $spectacleEntity->urlVideo;
            $spectacle->horairePrevionnel = $spectacleEntity->horairePrevionnel;
            $spectacle->idSoiree = $spectacleEntity->idSoiree;
            $spectacleDTOs[] = $spectacle->toDTO();
        }
        return $spectacleDTOs;
    }

    /**
     * @throws Exception
     */
    public function recupImagesBySpectacle(string $idSpectacle): array
    {
        $spectacle = Spectacle::where('idSpectacle', $idSpectacle)->first();
        $images = [];
        if (isset($spectacle)) {
            $imgs = ImgSpectacle::where('idSpectacle', $spectacle->idSpectacle)->get();
            // faire un foreach pour récupérer les images
            foreach ($imgs as $img) {
                $images[] = $img->img;
            }
        }
        else {
          throw new Exception('Spectacle introuvable');
        }
        return $images;
    }
}