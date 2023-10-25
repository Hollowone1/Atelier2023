<?php

namespace nrv\event\api\domain\entities\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\dto\event\ImgSpectacleDTO;

class ImgSpectacle extends Model
{

    protected $connection = 'event';
    protected $table = 'imgSpectacle';
    protected $primaryKey = 'idImg';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idImg',
        'img',
        'idSpectacle'
    ];

    public function toDTO(): ImgSpectacleDTO
    {
        return new ImgSpectacleDTO(
            $this->idImg,
            $this->img,
            $this->idSpectacle
        );
    }
}