<?php

namespace nrv\event\api\domain\entities\billet;

use Illuminate\Database\Eloquent\Model;
use nrv\event\api\domain\DTO\billet\billetDTO;

class Billet extends Model
{
    protected $connection = 'nrv.ticket';
    protected $table = 'billet';
    protected $primaryKey = 'idBillet';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'idBillet',
        'codeQR',
        'idUtilisateur',
        'idSoiree'
    ];

    public function toDTO(): billetDTO
    {
        return new billetDTO(
            $this->idBillet,
            $this->codeQR,
            $this->idUtilisateur,
            $this->idSoiree
        );
    }
}