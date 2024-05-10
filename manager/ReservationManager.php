<?php
include 'models/Reservation.php';

class ReservationManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getReservationsByPropriete($idProprio) {
        $reservations = array();

        $sql = "SELECT * FROM reservation WHERE idProprio = :idProprio";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":idProprio", $idProprio);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $reservation = new Reservation(
                $row['idReservation'],
                $row['idUtilisateur'],
                $row['idProprio'],
                $row['dateDebut'],
                $row['dateFin'],
                $row['montant']
            );
            $reservations[] = $reservation;
        }

        return $reservations;
    }

    
    public function insertReservation($idUtilisateur, Reservation $reservation, $montantPropriete) {
        $idProprio = $reservation->getIdProprio();
        $dateDebut = $reservation->getDateDebut();
        $dateFin = $reservation->getDateFin();
    
        try {
            // Préparation de la requête SQL
            $sql = "INSERT INTO reservation (idUtilisateur, idProprio, dateDebut, dateFin, montant) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
    
            // Exécution de la requête avec les valeurs liées
            $stmt->execute([$idUtilisateur, $idProprio, $dateDebut, $dateFin, $montantPropriete]);
    
            // Retourner true si l'insertion a réussi, sinon false
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs PDO si nécessaire
            echo "Erreur lors de l'insertion de la réservation : " . $e->getMessage();
            return false;
        }
    }
    
}

?>

