<?php

namespace nrv\event\api\domain\DTO\billet;
use nrv\event\api\domain\DTO;

class billetDTO extends DTO {
    
    public string $qrCode;

    public function __construct(string $qrCode)
    {
        $this->qrCode = $qrCode;
    }

    public function getQrCode(){
        return $this->qrCode;
    }
}