<?php
include 'views/template/header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idReservation = $_POST["idReservation"];

    if (!empty($idReservation)) {
        // Inclure votre fichier de configuration de la base de données et la classe Reservation
        require_once 'models/Database.php';
        require_once 'manager/ReservationManager.php';

        // Créer une instance de la classe Database et de ReservationManager
        $db = new Database();
        $reservationManager = new ReservationManager($db);

        // Récupérer les informations de la réservation à modifier
        $reservation = $reservationManager->getReservationById($idReservation);

        // Vérifier si la réservation a été trouvée
        if ($reservation) {
            echo '<div class="back-Admin-traitement">';
            echo '<div class="container-formulaire-reservation-admin">';
            echo '<form action="index.php?action=traitementReservation" method="POST">';
            echo '<input type="hidden" name="id_reservation" value="' . $idReservation . '">';
            echo '<div class="form-group-res">';
            echo '<label for="dateDebut">Date d\'arrivée :</label>';
            echo '<input type="date" name="dateDebut" id="dateDebut" value="' . $reservation->getDateDebut() . '" required>';
            echo '</div>';
            echo '<div class="form-group-res">';
            echo '<label for="dateFin">Date de départ :</label>';
            echo '<input type="date" name="dateFin" id="dateFin" value="' . $reservation->getDateFin() . '" required>';
            echo '</div>';
            echo '<div class="form-group-res">';
            echo '<input type="submit" value="Modifier">';
            echo '</div>';
        } else {
            echo 'La réservation avec l\'ID ' . $idReservation . ' n\'existe pas.';
        }
    }
}
?>
