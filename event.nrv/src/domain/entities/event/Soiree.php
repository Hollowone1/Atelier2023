<?php


namespace nrv\event\api\domain\entities\event;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\dto\soiree\SoireeDTO;

class Soiree extends Model
{

    protected $connection = 'event';
    protected $table = 'soiree';
    protected $primaryKey = 'idSoiree';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idSoiree',
        'nom',
        'theme',
        'date',
        'horaireDebut',
        'tarifNormal',
        'tarifReduit',
        'idLieu',
    ];

    public function toDTO(): SoireeDTO
    {
        return new SoireeDTO(
            $this->idSoiree,
            $this->nom,
            $this->theme,
            $this->date,
            $this->horaireDebut,
            $this->tarifNormal,
            $this->tarifReduit,
            $this->idLieu
        );
    }

}