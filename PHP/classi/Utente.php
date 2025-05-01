<?php

class Utente {
    private $id;
    private $username;
    private $password;
    private $ruolo;

    public function __construct($id, $username, $password, $ruolo) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->ruolo = $ruolo;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRuolo() {
        return $this->ruolo;
    }
}