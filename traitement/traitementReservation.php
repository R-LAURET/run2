<?php
include_once "models/DataBase.php";
include_once "manager/ReservationManager.php";
include_once "manager/ProprieteManager.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProprio = $_POST["idProprio"];
    $dateDebut = $_POST["dateDebut"];
    $dateFin = $_POST["dateFin"];

    if (!empty($idProprio) && !empty($dateDebut) && !empty($dateFin)) {
        session_start();
        $idUtilisateur = $_SESSION['id'];

        $db = new Database();
        $reservationManager = new ReservationManager($db);

        // Récupérer le montant de la propriété
        $proprieteManager = new ProprieteManager($db);
        $tarifParNuit = $proprieteManager->getMontantProprieteById($idProprio);

        if ($tarifParNuit !== null) {
            // Calculer le nombre de jours de réservation
            $dateDebutObj = new DateTime($dateDebut);
            $dateFinObj = new DateTime($dateFin);
            $difference = $dateFinObj->diff($dateDebutObj);
            $nombreJours = $difference->days;

            // Calculer le montant total
            $montantTotal = $nombreJours * $tarifParNuit;

            // Créer une instance de Reservation avec les valeurs nécessaires
            $reservation = new Reservation(null, $idUtilisateur, $idProprio, $dateDebut, $dateFin, $montantTotal);

            // Insérer la réservation dans la base de données
            $success = $reservationManager->insertReservation($idUtilisateur, $reservation,$montantTotal);

            if ($success) {
                // Rediriger vers une page de confirmation ou afficher un message de succès
                header("Location: index.php?action=reservation&&message=success");
                exit;
            } else {
                // Afficher un message d'erreur si l'insertion a échoué
                header("Location: index.php?action=reservation&&message=echec");
                exit;
            }
        } else {
            echo "Impossible de récupérer le tarif par nuit de la propriété.";
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire de réservation.";
    }
} else {
    header("Location: error.php");
    exit;
}
?>
