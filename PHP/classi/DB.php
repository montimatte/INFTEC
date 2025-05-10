<?php
    require_once("../classi/Buono.php");
    require_once("../classi/Polizza.php");
    require_once("../classi/Registro.php");
    require_once("../classi/Utente.php");
    require_once("../classi/Viaggio.php");
    require_once("../classi/Ritirante.php");

    class DB{
        private $url;

        public function __construct($url="http://127.0.0.1:8080/terminal"){
            $this->url=$url;
        }

        public function addUtente($utente){
            $username=$utente->getUsername();
            $password=$utente->getPassword();
            $ruolo=$utente->getRuolo();

            $url=$this->url."/addUtente.php?username=$username&password=$password&ruolo=$ruolo";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                return $json["error"];
            }
            return null;
        }

        public function getUtente($username, $password){
            $pswd=md5($password);
            $url=$this->url."/getUtente.php?username=$username&password=$pswd";
            $json = file_get_contents($url);
            $json = json_decode($json,true);
            if(isset($json["error"])){
                return null;
            }
            $utente=new Utente($json["user"]["id"],$json["user"]["username"],$json["user"]["password"], $json["user"]["ruolo"]);
            return $utente;
        }

        public function getUtenteByRuolo($ruolo){
            $url=$this->url."/getUtenteByRuolo.php?ruolo=$ruolo";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            $utenti=array();
            foreach($json["users"] as $user){
                array_push($utenti,new Utente($user["id"],$user["username"],"",""));
            }
            return $utenti;
        }

        public function getPolizze(){
            $url=$this->url."/getPolizze.php";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            $polizze=array();
            foreach($json["polizze"] as $polizza){
                array_push($polizze, new Polizza($polizza["id"],$polizza["id_viaggio"],$polizza["tipologiaMerce"],$polizza["peso"],$polizza["fornitore"],$polizza["giorniMagazzinaggio"],$polizza["tariffa"]));
            }
            return $polizze;
        }

        public function getPolizzaById($id){
            $url=$this->url."/getPolizzaById.php?id=$id";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            return new Polizza($json["polizza"]["id"],$json["polizza"]["id_viaggio"],$json["polizza"]["tipologiaMerce"],$json["polizza"]["peso"],$json["polizza"]["fornitore"],$json["polizza"]["giorniMagazzinaggio"],$json["polizza"]["tariffa"]);
        }

        public function inviaRichiesta($utente,$ritirante,$polizza,$peso){
            $url=$this->url."/inviaRichiestaBuono.php?idUtente=$utente&idRitirante=$ritirante&idPolizza=$polizza&peso=$peso";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                return $json["error"];
            }
            return null;
        }

        public function getBuoniAutotrasportatore($utente){
            $url=$this->url."/getBuoniAutotrasportatore.php?idUtente=$utente";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            $buoni=array();
            foreach($json["buoni"] as $buono){
                array_push($buoni,new Buono($buono["id"],$buono["cliente"],0,$buono["peso"],$buono["id_polizza"],$buono["tipologiaMerce"],"","",""));
            }
            return $buoni;
        }

        public function getBuoniCliente($utente){
            $url=$this->url."/getBuoniCliente.php?idUtente=$utente";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            $buoni=array();
            foreach($json["buoni"] as $buono){
                array_push($buoni,new Buono($buono["id"],"",0,$buono["peso"],$buono["id_polizza"],$buono["tipologiaMerce"], $buono["stato"],$buono["targa"],$buono["autotrasportatore"]));
            }
            return $buoni;
        }

        public function getBuoniByStato($stato){
            $tmp=urlencode($stato);
            $url=$this->url."/getBuoniByStato.php?stato=$tmp";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            $buoni=array();
            foreach($json["buoni"] as $buono){
                array_push($buoni,new Buono($buono["id"],$buono["cliente"],0,$buono["peso"],$buono["id_polizza"],$buono["tipologiaMerce"],$buono["stato"],"",""));
            }
            return $buoni;
        }

        public function updateBuono($id,$stato){
            $url=$this->url."/updateBuono.php?id=$id&stato=$stato";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                return $json["error"];
            }
            return null;
        }

        public function registraRitiro($ritirante,$buono){
            $url=$this->url."/registraRitiro.php?idRitirante=$ritirante&idBuono=$buono";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                return $json["error"];
            }
            return null;
        }

        public function registraCamion($targa, $idUtente){
            $url=$this->url."/addCamion.php?targa=$targa&idUtente=$idUtente";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
               return $json["error"];
            }
            return null;
        }

        public function getCamion($idUtente){
            $url=$this->url."/getCamionByCliente.php?idUtente=$idUtente";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            $camions=array();
            foreach($json["camion"] as $camion){
                array_push($camions,$camion);
            }
            return $camions;
        }

        public function getRitirantiByCliente($id){
            $url=$this->url."/getRitirantiByCliente.php?idCLiente=$id";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if(isset($json["error"])){
                return null;
            }

            $ritiranti=array();
            foreach($json["ritiranti"] as $ritirante){
                $r=new Ritirante($ritirante["id"],$ritirante["idAutotrasportatore"],$ritirante["autotrasportatore"],$ritirante["targa"]);
                array_push($ritiranti,$r);
            }
            return $ritiranti;
        }

        public function associaCamion($idCamion,$idAutotrasportatore){
            $url=$this->url."/addRitirante.php?idCamion=$idCamion&idAutotrasportatore=$idAutotrasportatore";
            $json = file_get_contents($url);
            $json = json_decode($json,true);

            if($json["error"]!= "OK"){
                return $json["error"];
            }
            return null;
        }
    }
?>