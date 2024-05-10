<?php
class Propriete {
    public $idProprio;
    public $nom;
    public $description;
    public $nombreChambre;
    public $tarif;
    public $adresse;

    public function __construct($idProprio, $nom, $description,$adresse, $nombreChambre, $tarif) {
        $this->idProprio = $idProprio;
        $this->nom = $nom;
        $this->description = $description;
        $this->adresse = $adresse;
        $this->nombreChambre = $nombreChambre;
        $this->tarif = $tarif;
    }
    public function getIdProprio() {
        return $this->idProprio;
    }
    public function setIdProprio($idProprio) {
        $this->idProprio = $idProprio;
    }
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getAdresse() {
        return $this->adresse;
    }
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
    public function getNombreChambre() {
        return $this->nombreChambre;
    }
    public function setNombreChambre($nombreChambre) {
        $this->nombreChambre = $nombreChambre;
    }
    public function getTarif() {
        return $this->tarif;
    }
    public function setTarif($tarif) {
        $this->tarif = $tarif;
    }
}
?>
