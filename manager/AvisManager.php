<?php
include 'models/Avis.php';
class AvisManager {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Méthode pour récupérer les avis avec les informations de l'utilisateur par identifiant de propriété
    public function getAvisByProprieteId($idPropriete) {
        try {
            $sql = "SELECT utilisateurs.nom, utilisateurs.prenom, avis_moderation.note, avis_moderation.commentaire, avis_moderation.date 
                    FROM avis_moderation 
                    INNER JOIN utilisateurs ON avis_moderation.idUtilisateur = utilisateurs.idUtilisateur
                    WHERE avis_moderation.idProprio = :id && avis_moderation.modere= 1 ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $idPropriete, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de la récupération des avis par identifiant de propriété: " . $e->getMessage();
            return null;
        }
    }
    public function getAvisNonModere(){
        try{
            $sql = "SELECT avis_moderation.*, utilisateurs.nom AS nom_utilisateur, utilisateurs.prenom AS prenom_utilisateur
            FROM avis_moderation 
            INNER JOIN utilisateurs ON avis_moderation.idUtilisateur = utilisateurs.idUtilisateur
            WHERE avis_moderation.modere = 0";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e){
            // Gérer les erreurs de base de données
            echo "Erreur lors de la récupération des avis non modérés: ". $e->getMessage();
            return null;
        }
    }
    public function accepterAvis($idAvis) {
        try {
            $sql = "UPDATE avis_moderation SET modere = 1 WHERE idAvis = :idAvis";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idAvis', $idAvis, PDO::PARAM_INT);
            $stmt->execute();
            
            // Retourne true si la mise à jour a été réussie
            return true;
        } catch(PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de l'acceptation de l'avis: ". $e->getMessage();
            // Retourne false en cas d'erreur
            return false;
        }
    }
    public function refuserAvis($idAvis) {
        try {
            $sql = "DELETE FROM avis_moderation WHERE idAvis = :idAvis";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idAvis', $idAvis, PDO::PARAM_INT);
            $stmt->execute();
            // Retourne true si la suppression a été réussie
            return true;
        } catch(PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors du refus de l'avis: ". $e->getMessage();
            // Retourne false en cas d'erreur
            return false;
        }
    }
    
    
    
}

    

?>
