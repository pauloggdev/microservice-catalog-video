<?php

namespace Core\Domain\ValueObject;

class Uuid{
    
    public function __construct(protected string $value){
        $this->ensureIsValid();

    }
    public function ensureIsValid(){

    }

}