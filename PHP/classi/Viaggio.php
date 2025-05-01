<?php

class Viaggio
{
    private $id;
    private $id_nave;
    private $id_portoPartenza;
    private $dataPartenza;
    private $id_portoArrivo;
    private $dataAllibbramento;
    private $linea;

    // Parametric constructor
    public function __construct($id, $id_nave, $id_portoPartenza, $dataPartenza, $id_portoArrivo, $dataAllibbramento, $linea)
    {
        $this->id = $id;
        $this->id_nave = $id_nave;
        $this->id_portoPartenza = $id_portoPartenza;
        $this->dataPartenza = $dataPartenza;
        $this->id_portoArrivo = $id_portoArrivo;
        $this->dataAllibbramento = $dataAllibbramento;
        $this->linea = $linea;
    }

    // Get methods
    public function getId()
    {
        return $this->id;
    }

    public function getIdNave()
    {
        return $this->id_nave;
    }

    public function getIdPortoPartenza()
    {
        return $this->id_portoPartenza;
    }

    public function getDataPartenza()
    {
        return $this->dataPartenza;
    }

    public function getIdPortoArrivo()
    {
        return $this->id_portoArrivo;
    }

    public function getDataAllibbramento()
    {
        return $this->dataAllibbramento;
    }

    public function getLinea()
    {
        return $this->linea;
    }
}
?>