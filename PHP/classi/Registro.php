<?php
class Registro {
    private $idBuono;
    private $cliente;
    private $targa;
    private $autotrasportatore;
    private $peso;
    private $id_polizza;
    private $tipologiaMerce;
    private $dataOraRitiro;

    public function __construct($idBuono,$cliente,$peso,$id_polizza,$tipologiaMerce,$targa,$autotrasportatore,$dataOraRitiro) {
        $this->idBuono = $idBuono;
        $this->cliente = $cliente;
        $this->peso = $peso;
        $this->id_polizza = $id_polizza;
        $this->tipologiaMerce = $tipologiaMerce;
        $this->targa = $targa;
        $this->autotrasportatore = $autotrasportatore;
        $this->dataOraRitiro = $dataOraRitiro;
    }

    public function getIdBuono() {
        return $this->idBuono;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getIdPolizza() {
        return $this->id_polizza;
    }

    public function getTipologiaMerce() {
        return $this->tipologiaMerce;
    }

    public function getTarga() {
        return $this->targa;
    }

    public function getAutotrasportatore() {
        return $this->autotrasportatore;
    }

    public function getDataOraRitiro() {
        return $this->dataOraRitiro;
    }
}
