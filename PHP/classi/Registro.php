<?php

class Registro {
    private $id;
    private $id_buono;
    private $dataOraRitiro;
    private $id_ritirante;

    public function __construct($id, $id_buono, $dataOraRitiro, $id_ritirante) {
        $this->id = $id;
        $this->id_buono = $id_buono;
        $this->dataOraRitiro = $dataOraRitiro;
        $this->id_ritirante = $id_ritirante;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdBuono() {
        return $this->id_buono;
    }

    public function getDataOraRitiro() {
        return $this->dataOraRitiro;
    }

    public function getIdRitirante() {
        return $this->id_ritirante;
    }
}