<?php 

class Avis {
    public $idAvis;
    public $idProprio;
    public $idUtilisateur;
    public $commentaire;
    public $note;
    public $date;
    public $modere;
    

    public function __construct($idAvis, $idProprio, $idUtilisateur, $commentaire, $note, $date ,$modere) {
        $this->idAvis = $idAvis;
        $this->idProprio = $idProprio;
        $this->idUtilisateur = $idUtilisateur;
        $this->commentaire = $commentaire;
        $this->note = $note;
        $this->date = $date;
        $this->modere = $modere;
    }

    public function getIdAvis() {
        return $this->idAvis;
    }
    public function setIdAvis($idAvis) {
        $this->idAvis = $idAvis;
    }
    public function getIdProprio() {
        return $this->idProprio;
    }
    public function setIdProprio($idProprio) {
        $this->idProprio = $idProprio;
    }
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }
    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }
    public function getCommentaire() {
        return $this->commentaire;
    }
    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }
    public function getNote() {
        return $this->note;
    }
    public function setNote($note) {
        $this->note = $note;
    }
    public function getDate() {
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function getModere() {
        return $this->modere;
    }
    public function setModere($modere) {
        $this->modere = $modere;
    }
    
}