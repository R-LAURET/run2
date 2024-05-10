<?php
class Utilisateur {
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $admin;

    public function __construct($id, $nom, $prenom, $email, $mdp, $admin) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->admin = $admin;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getMdp() {
        return $this->mdp;
    }
    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }
    public function getAdmin() {
        return $this->admin;
    }
    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    
}