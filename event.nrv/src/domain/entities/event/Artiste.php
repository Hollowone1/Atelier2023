<?php

namespace nrv\event\api\domain\DTO\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\dto\event\ArtisteDTO;
use nrv\event\api\domain\entities\event\Spectacle;

class Artiste extends Model
{

    protected $connection = 'nrv_event';
    protected $table = 'Artiste';
    protected $primaryKey = 'idArtiste';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idArtiste',
        'nom',
        'idImg'
    ];

    public function spectacles()
    {
        return $this->belongsToMany(Spectacle::class, 'spectacle', 'idSpectacle');
    }

    public function toDTO(): ArtisteDTO
    {
        return new ArtisteDTO(
            $this->idArtiste,
            $this->nom,
            $this->idImg
        );
    }
}