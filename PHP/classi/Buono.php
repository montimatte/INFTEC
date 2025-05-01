<?php

class Buono
{
    private $id; // Primary Key
    private $cliente;
    private $peso;
    private $id_polizza; // Foreign Key

    public function __construct($id, $cliente, $peso, $id_polizza)
    {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->peso = $peso;
        $this->id_polizza = $id_polizza;
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
}