<?php

include 'manager/AvisManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    if (!isset($_SESSION['idPropriete']) || !isset($_SESSION['id'])) {
        exit("Erreur: Les informations de session sont manquantes.");
    }

    $idPropriete = $_SESSION['idPropriete'];
    $idUtilisateur = $_SESSION['id'];
    $commentaire = $_POST['commentaire'];
    $note = $_POST['note'];
    $date = date('Y-m-d H:i:s');
    $modere = false; 

    $db = new Database();
    $avisManager = new AvisManager($db);

    $nombreAvis = $avisManager->getNombreAvisUtilisateurSurPropriete($idUtilisateur, $idPropriete);

    if ($nombreAvis < 4) {
        $avis = new Avis(null, $idPropriete, $idUtilisateur, $commentaire, $note, $date, $modere);
        $resultat = $avisManager->ajouterAvis($avis);

        if ($resultat) {
            header("location: index.php?action=AfficherInsererAvis&message=successAvis");
            exit();
        } else {
            header("location: index.php?action=AfficherInsererAvis&message=echecAvis");
            exit();
        }
    } else {
        header("location: index.php?action=AfficherInsererAvis&message=limiteAvis");
        exit();
    }
}

