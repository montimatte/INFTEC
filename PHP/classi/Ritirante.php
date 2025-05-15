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

        public function getAutotrasportatore() {
            return $this->autotrasportatore;
        }

        public function getTarga() {
            return $this->targa;
        }

        public function getId() {
            return $this->id;
        }
    }
?>
