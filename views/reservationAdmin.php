<?php 
include ('views/template/header.php');

require_once 'models/Database.php';
require_once 'manager/ReservationManager.php';

$db = new Database();
$reservationManager = new ReservationManager($db);
$toutesLesReservations = $reservationManager->getAllReservations();

// Afficher le tableau HTML
echo '<div class="back-reservation-admin">';
echo '<table>';
echo '<tr><th>ID</th><th>ID Proprio</th><th>ID Utilisateur</th><th>Date Début</th><th>Date Fin</th><th>Montant</th><th>Actions</th></tr>';
foreach ($toutesLesReservations as $reservation) {
    echo '<tr>';
    echo '<td>' . $reservation->getIdReservation() . '</td>';
    echo '<td>' . $reservation->getIdProprio() . '</td>';
    echo '<td>' . $reservation->getIdUtilisateur() . '</td>';
    echo '<td>' . $reservation->getDateDebut() . '</td>';
    echo '<td>' . $reservation->getDateFin() . '</td>';
    echo '<td>' . $reservation->getMontant() . '</td>';
    echo '<td>';
    echo '<form action="index.php?action=ReservationModifAdmin" method="post">';
    echo '<input type="hidden" name="idReservation" value="' . $reservation->getIdReservation() . '">';
    echo '<input class ="lien-admin-modif" type="submit" value="Modifier">';
    echo '</form>';
    echo '<form action="index.php?action=ReservationModifAdmin" method="post">';
    echo '<input type="hidden" name="idReservation" value="' . $reservation->getIdReservation() . '">';
    echo '<input class ="lien-admin-modif" type="submit" value="Supprimer">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';

?>
