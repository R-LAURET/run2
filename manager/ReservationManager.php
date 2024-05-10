<?php
include 'models/Reservation.php';

class ReservationManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllReservations() {
        $reservations = array();

        $query = "SELECT * FROM reservation";

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Création d'un nouvel objet Reservation avec les données récupérées de la base de données
            $reservation = new Reservation($row['idReservation'], $row['idProprio'], $row['idUtilisateur'], $row['dateDebut'], $row['dateFin'], $row['montant']);
            $reservations[] = $reservation;
        }

        // Retourner le tableau de réservations
        return $reservations;
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
    public function getReservationById($idReservation) {
        $query = "SELECT * FROM reservation WHERE idReservation = :idReservation";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':idReservation', $idReservation, PDO::PARAM_INT);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $reservation = new Reservation($row['idReservation'], $row['idProprio'], $row['idUtilisateur'], $row['dateDebut'], $row['dateFin'], $row['montant']);
            return $reservation;
        } else {
            return null; 
        }
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

