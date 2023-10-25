<?php

namespace nrv\event\api\domain\entities\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\dto\event\ImgLieuDTO;

class ImgLieu extends Model
{

    protected $connection = 'event';
    protected $table = 'imgLieu';
    protected $primaryKey = 'idImg';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idImg',
        'img',
        'idLieu'
    ];

    public function toDTO(): ImgLieuDTO
    {
        return new ImgLieuDTO(
            $this->idImg,
            $this->img,
            $this->idLieu
        );
    }
}