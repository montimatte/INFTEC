<?php
    class Ritirante{
        private $idAutotraportatore;
        private $autotrasportatore;
        private $targa;
        private $id;

        public function __construct($id, $idAutotraportatore, $autotrasportatore, $targa) {
            $this->id = $id;
            $this->idAutotraportatore = $idAutotraportatore;
            $this->autotrasportatore = $autotrasportatore;
            $this->targa = $targa;
        }

        public function getIdAutotraportatore() {
            return $this->idAutotraportatore;
        }

        public function setIdAutotraportatore($idAutotraportatore) {
            $this->idAutotraportatore = $idAutotraportatore;
        }

        public function getAutotrasportatore() {
            return $this->autotrasportatore;
        }

        public function setAutotrasportatore($autotrasportatore) {
            $this->autotrasportatore = $autotrasportatore;
        }

        public function getTarga() {
            return $this->targa;
        }

        public function setTarga($targa) {
            $this->targa = $targa;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }
    }
?>