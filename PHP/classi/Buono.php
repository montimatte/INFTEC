<?php

class Buono
{
    private $id; // Primary Key
    private $cliente;
    private $peso;
    private $id_polizza; // Foreign Key
    private $tipologiaMerce;

    public function __construct($id, $cliente, $peso, $id_polizza, $tipologiaMerce)
    {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->peso = $peso;
        $this->id_polizza = $id_polizza;
        $this->tipologiaMerce=$tipologiaMerce;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCliente()
    {
        return $this->cliente;
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
}