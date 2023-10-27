<?php

namespace nrv\event\api\domain\service\classes;

use Exception;
use nrv\event\api\domain\DTO\event\SpectacleDTO;
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
        $spectacleEntity->horaire = $spectacleDTO->horaire;
        return new SpectacleDTO($spectacleEntity->titre, $spectacleEntity->description, $spectacleEntity->urlVideo, $spectacleEntity->horaire);
    }

    /**
     * @throws Exception
     */
    public function recupSpectacle(string $id): SpectacleDTO
    {
        $billetEntity = Spectacle::find($id);
        if ($billetEntity == null) {
            throw new Exception("Billet introuvable");
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
        $spectacles = Spectacle::all();
        $spectaclesDTO = [];
        foreach ($spectacles as $spectacle) {
            $spectaclesDTO[] = $spectacle->toDTO();
        }
        return $spectaclesDTO;
    }

}