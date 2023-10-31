<?php

namespace nrv\event\api\domain\DTO\event;

class ImgLieuDTO
{
    public string $idImg;
    public string $img;
    public string $idLieu;

    public function __construct(string $idImg, string $img, string $idLieu)
    {
        $this->idImg = $idImg;
        $this->img = $img;
        $this->idLieu = $idLieu;
    }

    public function toArray(): array
    {
        return [
            'idImg' => $this->idImg,
            'img' => $this->img,
            'idLieu' => $this->idLieu,
        ];
    }
}