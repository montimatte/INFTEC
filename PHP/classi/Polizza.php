<?php

class Polizza
{
    private $id; // Primary Key
    private $id_viaggio; // Foreign Key
    private $tipologiaMerce;
    private $peso;
    private $fornitore;
    private $giorniMagazzinaggio;
    private $tariffa;

    // Parametric constructor
    public function __construct($id, $id_viaggio, $tipologiaMerce, $peso, $fornitore, $giorniMagazzinaggio, $tariffa)
    {
        $this->id = $id;
        $this->id_viaggio = $id_viaggio;
        $this->tipologiaMerce = $tipologiaMerce;
        $this->peso = $peso;
        $this->fornitore = $fornitore;
        $this->giorniMagazzinaggio = $giorniMagazzinaggio;
        $this->tariffa = $tariffa;
    }

    // Get methods
    public function getId()
    {
        return $this->id;
    }

    public function getIdViaggio()
    {
        return $this->id_viaggio;
    }

    public function getTipologiaMerce()
    {
        return $this->tipologiaMerce;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function getFornitore()
    {
        return $this->fornitore;
    }

    public function getGiorniMagazzinaggio()
    {
        return $this->giorniMagazzinaggio;
    }

    public function getTariffa()
    {
        return $this->tariffa;
    }
}