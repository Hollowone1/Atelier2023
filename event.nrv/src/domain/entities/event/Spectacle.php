<?php

namespace nrv\event\api\domain\entities\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\DTO\event\Artiste;
use nrv\event\api\domain\DTO\event\SpectacleDTO;

class Spectacle extends Model
{

    protected $connection = 'event';
    protected $table = 'Spectacle';
    protected $primaryKey = 'idSpectacle';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idSpectacle',
        'titre',
        'description',
        'urlVideo',
        'horairePrevionnel',
        'idSoiree'
        //'idImg',
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
        $spec = new SpectacleDTO(
            $this->idSpectacle,
            $this->titre,
            $this->description,
            $this->urlVideo,
            $this->horairePrevionnel,
            $this->idSoiree);

        return $spec;
    }
}