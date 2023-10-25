<?php

namespace nrv\event\api\domain\ticket\DTO;
use nrv\event\api\domain\DTO;

class ticketDTO extends DTO {
    
    public string $qrCode;

    public function __construct(string $qrCode)
    {
        $this->qrCode = $qrCode;
    }

    public function getQrCode(){
        return $this->qrCode;
    }
}