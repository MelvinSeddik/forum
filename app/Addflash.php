<?php

namespace App;

class Addflash{

    private $code;
    private $message;
    private $time;

    function __construct(int $code = 0, string $message = ""){
        $this->code = $code;
        $this->message = $message;

    }
    
    function __toString(){
        return ($this->code != 0) ? "Erreur : " .$this->message : "";
    }

    function setError(int $code = 0, string $message = ""){
        $this->code = $code;
        $this->message = $message; 
    }

    function setSuccess(int $code = 0, string $message = ""){
        $this->code = $code;
        $this->message = $message; 
    }
}

