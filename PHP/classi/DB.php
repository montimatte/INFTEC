<?php
    class DB{
        private $url;

        public function __construct($url="127.0.0.1:8080/api/terminal"){
            $this->url=$url;
        }

        public function addUtente($utente){
            $username=$utente->getUsername();
            $password=$utente->getPassword();
            $ruolo=$utente->getRuolo();

            $url=$this->url."/addUtente.php?username='$username'&password='$password'&ruolo='$ruolo'";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                die("".$json["error"]."");
            }
        }

        public function getUtente($username, $password){
            $pswd=md5($password);
            $url=$this->url."/getUtente.php?username='$username'&password='$pswd'";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            $utente=new Utente($json->id,$json->username,$json->password, $json->ruolo);
            return $utente;
        }

        public function getUtenteByRuolo($ruolo){
            $url=$this->url."/getUtenteByRuolo.php?ruolo='$ruolo'";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            $utenti=array();
            foreach($json->users as $user){
                array_push($utenti,new Utente($user->id,$user->username,"",""));
            }
            return $utenti;
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

        public function inviaRichiesta($utente,$ritirante,$polizza,$peso){
            $url=$this->url."/inviaRichiestaBuono.php?idUtente='$utente'&idRitirante='$ritirante'&idPolizza='$polizza'&peso='$peso'";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                die("".$json["error"]."");
            }
        }

        public function getBuoni($utente){
            $url=$this->url."/getBuoni.php?idUtente='$utente'";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            $buoni=array();
            foreach($json->buoni as $buono){
                array_push($buoni,new Buono($buono->id,$buono->cliente,$buono->peso,$buono->id_polizza));
            }
            return $buoni;
        }
    }
?>