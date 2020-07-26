<?php

include_once 'model/Terminal.php';
include_once 'model/Jalur.php';

class Graph{

    private $isDirected;
    private $terminal;
    private $jalur;
    private $idTerminal;
    private $MAX_ITERATION = 100;
    private $MAX_TABU_SIZE = 2000;

    function __construct(
        $isDirected = false){
            $this->isDirected = $isDirected;

            $this->idTerminal = array();
            $this->terminal = array();
            $this->jalur = array();
    }

    public function TabuSearch($from, $to){
        $jalurTerbaik = 0;
        $daftarjalur = array();
        $tabuQueue = array();
        echo "<table border='1s' style='border-spacing: 2;text-align: justify;border-color: #fefefe;'>";
        echo "<tr><th>Iterasi Ke:</th><th>Jalur</th><th>Jarak</th>";
        for ($i=0; $i < $this->MAX_ITERATION; $i++) { 
            $now = $from;
            $jalurSekarang = $now;
            $jarakSekarang = 0;
            while ($now != $to) {
                $idNow = $this->getId($now);
                $daftarTetangga = array();
                $jarakTetangga = array();
                foreach($this->jalur[$idNow] as $tetangga){
                    $nama = $this->terminal[$tetangga->getDestination()]->getNamaTerminal();
                    $jarak = $tetangga->getWeight();
                    if(!in_array($now.$nama, $tabuQueue)) {
                        array_push($daftarTetangga, $nama);
                        $jarakTetangga[$nama] = $jarak;
                    }
                }
                if(sizeof($daftarTetangga) == 0){
                    $listIndex = array();                    
                    foreach($this->jalur[$idNow] as $tetangga){
                        $nama = $this->terminal[$tetangga->getDestination()]->getNamaTerminal();
                        
                        $index = array_search($now.$nama, $tabuQueue);
                        array_push($listIndex, $index);
                        
                        $jarak = $tetangga->getWeight();
                        array_push($jarakTetangga, $jarak);
                    }
                    $min = min($listIndex);
                    $nama = $tabuQueue[$min];
                    $now = substr($nama,-1);

                    unset($tabuQueue[$min]);
                    array_push($tabuQueue, $nama);
                    $jarakSekarang += $jarakTetangga[array_search($min, $listIndex)];
                    $jalurSekarang .= " - ". $now;
                    
                }
                else{
                    $min = min($jarakTetangga);
                    $next = array_search($min, $jarakTetangga);
                    $jarakSekarang += $min;
                    array_push($tabuQueue, $now.$next);
                    $jalurSekarang .= " - ". $next;
                    $now = $next;
                } 
            }            
            echo "<tr><td>$i</td><td>$jalurSekarang</td><td>$jarakSekarang</td><tr>";
            
            array_push($daftarjalur,array("jalur" => $jalurSekarang, "jarak" => $jarakSekarang));

            $jalurTerbaik = $daftarjalur[$jalurTerbaik]["jarak"] > $jarakSekarang ? $i : $jalurTerbaik;
        }
        echo "</table>";
        
        return "jalur terbaik adalah ".$daftarjalur[$jalurTerbaik]["jalur"]." dengan jarak ".$daftarjalur[$jalurTerbaik]["jarak"];
    }


    public function addTerminal($name, $alamat, $lat, $long){
        $id = $this->generateId();
        $terminal = new Terminal($id,$name, $alamat, $lat, $long);
        
        $this->idTerminal[$name] = $id;
        $this->jalur[$id] = array();
        $this->terminal[$id] = $terminal;
    }

    public function addJalur($terminalAsal, $terminalTujuan, $panjang){
        $jalur = new Jalur($this->getId($terminalAsal), $this->getId($terminalTujuan), $panjang);
        $this->jalur[$jalur->getSource()][$jalur->getDestination()] = $jalur;
    }
    
    private function generateId(){
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $id = '';
        for ($i=0; $i < 6; $i++) { 
            $random_character = $char[mt_rand(0, strlen($char) - 1)];
            $id .= $random_character;
        }

        return $id;
    }

    private function getId($namaTerminal){
        return $this->idTerminal[$namaTerminal];
    }

}