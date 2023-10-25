<?php

namespace nrv\event\api\domain\entities\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\dto\event\LieuDTO;

class Lieu extends Model
{

    protected $connection = 'event';
    protected $table = 'lieu';
    protected $primaryKey = 'idLieu';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idLieu',
        'nom',
        'adresse',
        'nbPlacesAssises',
        'nbPlacesDebout',
        'idImg',
    ];

    public function toDTO(): LieuDTO
    {
        return new LieuDTO(
            $this->idLieu,
            $this->nom,
            $this->adresse,
            $this->nbPlacesAssises,
            $this->nbPlacesDebout,
            $this->idImg
        );
    }
}