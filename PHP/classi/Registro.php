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

    public function setIdBuono($id) {
        $this->idBuono = $id;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function getIdPolizza() {
        return $this->id_polizza;
    }

    public function setIdPolizza($id_polizza) {
        $this->id_polizza = $id_polizza;
    }

    public function getTipologiaMerce() {
        return $this->tipologiaMerce;
    }

    public function setTipologiaMerce($tipologiaMerce) {
        $this->tipologiaMerce = $tipologiaMerce;
    }

    public function getTarga() {
        return $this->targa;
    }

    public function setTarga($targa) {
        $this->targa = $targa;
    }

    public function getAutotrasportatore() {
        return $this->autotrasportatore;
    }

    public function setAutotrasportatore($autotrasportatore) {
        $this->autotrasportatore = $autotrasportatore;
    }

    public function getDataOraRitiro() {
        return $this->dataOraRitiro;
    }

    public function setDataOraRitiro($dataOraRitiro) {
        $this->dataOraRitiro = $dataOraRitiro;
    }
}
