<?php
    class DB{
        private $url;

        public function __construct($url="127.0.0.1:8080/api/terminal"){
            $this->url=$url;
        }

        public function getUtente($username, $password){
            $url=$this->url."/getUtente.php?username='$username'&password='$password'";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            $utente=new Utente($json->id,$json->username,$json->password, $json->ruolo);
            return $utente;
        }

        public function getPolizze(){
            $url=$this->url."/getPolizze.php";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            $polizze=array();
            foreach($json->polizze as $polizza){
                array_push($polizze, new Polizza($polizza->id,$polizza->id_viaggio,$polizza->tipologiaMerce,$polizza->peso,$polizza->fornitore,$polizza->giorniMagazzinaggio,$polizza->tariffa));
            }
            return $polizze;
        }

        public function getPolizzaById($id){
            $url=$this->url."/getPolizze.php?id='$id'";
            $json = file_get_contents($url);
            $polizza = json_decode($json,true);

            return new Polizza($polizza->id,$polizza->id_viaggio,$polizza->tipologiaMerce,$polizza->peso,$polizza->fornitore,$polizza->giorniMagazzinaggio,$polizza->tariffa);
        }

        public function inviaRichiesta($utente,$polizza,$peso){
            $url=$this->url."/inviaRichiestaBuono.php?idUtente='$utente',idPolizza='$polizza',peso='$peso'";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                die("".$json["error"]."");
            }
        }
    }
?>