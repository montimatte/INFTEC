<?php

class Buono
{
    private $id;
    private $cliente;

    private $idRitirante;
    private $targa;
    private $autotrasportatore;
    private $peso;
    private $id_polizza;
    private $tipologiaMerce;

    private $stato;

    public function __construct($id, $cliente, $idRitirante, $peso, $id_polizza,$tipologiaMerce,$stato, $targa, $autotrasportatore)
    {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->idRitirante = $idRitirante;
        $this->targa = $targa;
        $this->autotrasportatore = $autotrasportatore;
        $this->peso = $peso;
        $this->id_polizza = $id_polizza;
        $this->tipologiaMerce = $tipologiaMerce;
        $this->stato = $stato;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getIdRitirante()
    {
        return $this->idRitirante;
    }

    public function getTarga()
    {
        return $this->targa;
    }

    public function getAutotrasportatore()
    {
        return $this->autotrasportatore;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function getIdPolizza()
    {
        return $this->id_polizza;
    }

    public function getTipologiaMerce()
    {
        return $this->tipologiaMerce;
    }

    public function getStato()
    {
        return $this->stato;
    }
}