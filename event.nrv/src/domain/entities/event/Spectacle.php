<?php

namespace nrv\event\api\domain\entities\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\DTO\event\Artiste;
use nrv\event\api\domain\DTO\event\SpectacleDTO;

class Spectacle extends Model
{

    protected $connection = 'event';
    protected $table = 'spectacle';
    protected $primaryKey = 'idSpectacle';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idSpectacle',
        'titre',
        'description',
        'urlVideo',
        'horairePrevisionnel',
        'idSoiree',
        'idImg',
    ];

    public function soirees()
    {
        return $this->belongsToMany(Soiree::class, 'soiree', 'idSoiree');
    }

    public function imgspectacles()
    {
        return $this->hasMany(ImgSpectacle::class, 'idImg');
    }

    public function artistes()
    {
        return $this->belongsToMany(Artiste::class, 'artiste', 'idArtiste');
    }

    public function toDTO(): SpectacleDTO
    {
        return new SpectacleDTO(
            $this->idSpectacle,
            $this->titre,
            $this->description,
            $this->urlVideo,
            $this->horairePrevisionnel,
            $this->idSoiree,
            $this->idImg
        );
    }
}