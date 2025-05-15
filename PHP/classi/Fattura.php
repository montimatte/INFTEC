<?php

class Fattura {
    private $id;
    private $importo;
    private $idBuono;
    private $merce;
    private $peso;

    public function __construct($id, $importo, $idBuono, $merce, $peso) {
        $this->id = $id;
        $this->importo = $importo;
        $this->idBuono = $idBuono;
        $this->merce = $merce;
        $this->peso = $peso;
    }

    public function getId() {
        return $this->id;
    }

    public function getImporto() {
        return $this->importo;
    }

    public function getIdBuono() {
        return $this->idBuono;
    }

    public function getMerce() {
        return $this->merce;
    }

    public function getPeso() {
        return $this->peso;
    }
}
