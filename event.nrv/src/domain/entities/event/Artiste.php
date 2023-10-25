<?php

namespace nrv\event\api\domain\DTO\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\dto\event\ArtisteDTO;

class Artiste extends Model
{

    protected $connection = 'event';
    protected $table = 'artiste';
    protected $primaryKey = 'idArtiste';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idArtiste',
        'nom',
        'idImg'
    ];

    public function toDTO(): ArtisteDTO
    {
        return new ArtisteDTO(
            $this->idArtiste,
            $this->nom,
            $this->idImg
        );
    }
}