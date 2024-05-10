<?php

class Reservation {
    private $idReservation;
    private $idUtilisateur;
    private $idProprio;
    private $dateDebut;
    private $dateFin;
    private $montant;

    public function __construct($idReservation, $idUtilisateur, $idProprio, $dateDebut, $dateFin, $montant) {
        $this->idReservation = $idReservation;
        $this->idUtilisateur = $idUtilisateur;
        $this->idProprio = $idProprio;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->montant = $montant; 
    }

    public function getIdReservation() {
        return $this->idReservation;
    }

    public function setIdReservation($idReservation) {
        $this->idReservation = $idReservation;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdProprio() {
        return $this->idProprio;
    }

    public function setIdProprio($idProprio) {
        $this->idProprio = $idProprio;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    public function getMontant() {
        return $this->montant;
    }

    public function setMontant($montant) {
        $this->montant = $montant;
    }
}

?>
