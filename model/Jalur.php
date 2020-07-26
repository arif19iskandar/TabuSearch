<?php

class Jalur{

    private $source;
    private $destination;
    private $weight;    

    function __construct(
        $source = null,
        $destination = null,
        $weight = null){

            $this->source = $source;
            $this->destination = $destination;
            $this->weight = $weight;
    }

    public function getSource(){
        return $this->source;
    }

    public function getDestination(){
        return $this->destination;
    }

    public function getWeight(){
        return $this->weight;
    }
}