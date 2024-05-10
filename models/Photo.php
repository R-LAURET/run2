<?php

class Photo {
    private $idPhoto;
    private $image;
    private $idProprio;

    public function __construct($idPhoto, $image, $idProprio) {
        $this->idPhoto = $idPhoto;
        $this->image = $image;
        $this->idProprio = $idProprio;
    }

    public function getIdPhoto() {
        return $this->idPhoto;
    }
    public function setIdPhoto($idPhoto) {
        $this->idPhoto = $idPhoto;
    }
    public function getImage() {
        return $this->image;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    public function getIdProprio() {
        return $this->idProprio;
    }
    public function setIdProprio($idProprio) {
        $this->idProprio = $idProprio;
    }

}
?>
