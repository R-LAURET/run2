<?php
include 'models/Propriete.php';
class ProprieteManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Méthode pour récupérer toutes les propriétés depuis la base de données
    public function getAllProprietes() {
        $proprietes = array();

        // Remplacez 'propriete' par le nom de votre table de propriétés
        $sql = "SELECT * FROM propriete";
        $stmt = $this->db->executer($sql);

        // Parcourir les résultats et créer des objets Propriete
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $propriete = new Propriete($row['idProprio'], $row['nom'], $row['description'],$row['adresse'],$row['nombreChambre'],$row['tarif']);
            $proprietes[] = $propriete;
        }

        return $proprietes;
    }
    public function getProprieteImage($idProprio){
        try {
            $sql = "SELECT image FROM photo WHERE idProprio = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $idProprio);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result && isset($result['image'])) {
                return $result['image'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de la récupération de la photo du coach: " . $e->getMessage();
            return null;
        }
    }
    public function getIdImagePropriete($idProprio) {
        try {
            $query = "SELECT idPhoto FROM photo WHERE idProprio = :idProprio";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":idProprio", $idProprio);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Vérifier si la requête a retourné des résultats
            if ($result !== false && isset($result['idPhoto'])) {
                return $result['idPhoto'];
            } else {
                return null; // Aucun résultat trouvé
            }
        } catch (PDOException $e) {
            // Gérer l'erreur de récupération de l'ID de l'image
            echo "Erreur lors de la récupération de l'ID de l'image : " . $e->getMessage();
            return false;
        }
    }
    
    public function getImageByUtilisateur($idProprio, $idImage){
        try {
            $sql = "SELECT image FROM photo WHERE idProprio = :id AND idPhoto= :idPhoto";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $idProprio);
            $stmt->bindParam(':idPhoto', $idImage);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result && isset($result['image'])) {
                return $result['image'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de la récupération de la photo du coach: " . $e->getMessage();
            return null;
        }
    }
    public function getProprieteById($id) {
        try {
            $sql = "SELECT * FROM propriete WHERE idProprio = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                // Créez et retournez un objet Propriete avec les détails récupérés
                return new Propriete($result['idProprio'], $result['nom'], $result['description'], $result['adresse'], $result['nombreChambre'], $result['tarif']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de la récupération de la propriété: " . $e->getMessage();
            return null;
        }
    }

    public function getProprietesByUtilisateurId($utilisateurId) {
        try {
            $sql = "SELECT * FROM propriete WHERE idUtilisateur = :utilisateurId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':utilisateurId', $utilisateurId);
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $proprietes = [];
    
            if ($result) {
                foreach ($result as $row) {
                    $propriete = new Propriete(
                        $row['idProprio'],
                        $row['nom'],
                        $row['description'],
                        $row['adresse'],
                        $row['nombreChambre'],
                        $row['tarif']
                    );
                    $proprietes[] = $propriete;
                }
            }
    
            return $proprietes;
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de la récupération des propriétés de l'utilisateur : " . $e->getMessage();
            return [];
        }
    }
    

    public function insererPropriete($idUtilisateur, $nom, $adresse, $description, $nombreChambre, $tarif, $imagePath) {
        try {
            // Insérer les détails de la propriété dans la table propriete
            $sql = "INSERT INTO propriete (idUtilisateur, nom, adresse, description, nombreChambre, tarif) VALUES (:idUtilisateur, :nom, :adresse, :description, :nombreChambre, :tarif)";
            
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam(':idUtilisateur', $idUtilisateur);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':nombreChambre', $nombreChambre);
            $stmt->bindParam(':tarif', $tarif);
    
            $stmt->execute();
    
            $idPropriete = $this->db->lastInsertId();
    
            // Insérer l'image dans la table photo
            $this->insererPhoto($imagePath, $idPropriete);
    
            return $idPropriete;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de la propriété : " . $e->getMessage();
            return false;
        }
    }
    
    public function insererPhoto($imagePath, $idPropriete) {
        try {
            $sql = "INSERT INTO photo (image, idProprio) VALUES (:image, :idProprio)";
            
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam(':image', $imagePath);
            $stmt->bindParam(':idProprio', $idPropriete);
    
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de la photo : " . $e->getMessage();
            return false;
        }
    }
    
    

    public function getMontantProprieteById($idProprio) {
        try {
            // Préparation de la requête SQL
            $sql = "SELECT tarif FROM propriete WHERE idProprio = ?";
            $stmt = $this->db->prepare($sql);

            // Exécution de la requête avec l'ID de la propriété lié
            $stmt->execute([$idProprio]);

            // Récupération du montant de la propriété depuis le résultat de la requête
            $montantPropriete = $stmt->fetchColumn();

            // Retourner le montant de la propriété
            return $montantPropriete;
        } catch (PDOException $e) {
            // Gérer les erreurs PDO si nécessaire
            echo "Erreur lors de la récupération du montant de la propriété : " . $e->getMessage();
            return null;
        }
    }
    
}
?>
