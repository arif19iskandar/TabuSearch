<?php

class Terminal{

    private $idTerminal;
    private $namaTerminal;
    private $alamatTerminal;
    private $lat;
    private $long;

    function __construct(
        $idTerminal = null,
        $namaTerminal = null,
        $alamatTerminal = null,
        $lat = null,
        $long = null){

            $this->idTerminal = $idTerminal;
            $this->namaTerminal = $namaTerminal;
            $this->alamatTerminal = $alamatTerminal;
            $this->lat = $lat;
            $this->long = $long;
    }

    public function getIdterminal(){
        return $this->idTerminal;
    }

    public function getNamaterminal(){
        return $this->namaTerminal;
    }

    public function getAlamatterminal(){
        return $this->alamatterminal;
    }

    public function getLat(){
        return $this->lat;
    }

    public function getLong(){
        return $this->long;
    }
}