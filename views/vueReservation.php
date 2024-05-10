<?php 

include_once "views/template/header.php";
$db = new Database();

include 'manager/ReservationManager.php';
$reservationManager = new ReservationManager($db);
?>
<div class="reservation-back"> 
    <?php
        $idProprio = $_SESSION['idPropriete'];

        $reservations = $reservationManager->getReservationsByPropriete($idProprio);

        if ($reservations !== null) {
            ?>
            <div class="reservation-list">
                <h2>Liste des réservations pour cette propriété</h2>
                <ul>
                    <?php foreach ($reservations as $reservation): ?>
                        <li>
                            Réservation du <?php echo $reservation->getDateDebut(); ?> au <?php echo $reservation->getDateFin(); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
        } else {
            echo "<p>Aucune réservation trouvée pour cette propriété.</p>";
        }

    ?>

    <div class="reservation-form">
        <h2>Réserver cette propriété :</h2>
        <div class="<?php echo isset($_GET['message']) && $_GET['message'] == 'success' ? 'success' : 'error'; ?>">
            <?php
            if (isset($_GET['message'])&& $_GET['message'] == 'success') {
                echo 'Réservation effectuée avec succès!';
            }elseif (isset($_GET['message']) && $_GET['message'] == 'echec'){
                echo ('Veillez vérifier que votre reservation n\'est pas déjà occupé' );
            }
            ?>
        </div>

        <form action="index.php?action=TraiterReservation" method="post">
            <input type="hidden" name="idProprio" value="<?php echo $_SESSION['idProprio']; ?>">
            <div class="form-group">
                <label for="dateDebut">Date d'arrivée :</label>
                <input type="date" name="dateDebut" id="dateDebut" required>
            </div>
            <div class="form-group">
                <label for="dateFin">Date de départ :</label>
                <input type="date" name="dateFin" id="dateFin" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Réserver">
            </div>
        </form>
    </div>
</div>