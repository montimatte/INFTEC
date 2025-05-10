<?php

class Buono
{
    private $id; // Primary Key
    private $cliente;

    private $idRitirante;
    private $targa;
    private $autotrasportatore;
    private $peso;
    private $id_polizza; // Foreign Key
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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getIdRitirante()
    {
        return $this->idRitirante;
    }

    public function setIdRitirante($idRitirante)
    {
        $this->idRitirante = $idRitirante;
    }

    public function getTarga()
    {
        return $this->targa;
    }

    public function setTarga($targa)
    {
        $this->targa = $targa;
    }

    public function getAutotrasportatore()
    {
        return $this->autotrasportatore;
    }

    public function setAutotrasportatore($autotrasportatore)
    {
        $this->autotrasportatore = $autotrasportatore;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function getIdPolizza()
    {
        return $this->id_polizza;
    }

    public function setIdPolizza($id_polizza)
    {
        $this->id_polizza = $id_polizza;
    }

    public function getTipologiaMerce()
    {
        return $this->tipologiaMerce;
    }

    public function setTipologiaMerce($tipologiaMerce)
    {
        $this->tipologiaMerce = $tipologiaMerce;
    }

    public function getStato()
    {
        return $this->stato;
    }

    public function setStato($stato)
    {
        $this->stato = $stato;
    }
}