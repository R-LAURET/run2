<?php

require_once 'models/Photo.php';
require_once 'models/Database.php'; // Supposons que vous avez une classe Database pour gérer la connexion à la base de données

class PhotoManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getPhotoById($id) {
        try {
            $query = "SELECT * FROM photo WHERE idPhoto = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $photoData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($photoData) {
                return new Photo($photoData['idPhoto'], $photoData['image'], $photoData['idProprio']);
            } else {
                return null; // Aucune photo trouvée avec cet ID
            }
        } catch (PDOException $e) {
            // Gérer l'erreur de base de données
            echo "Erreur lors de la récupération de la photo : " . $e->getMessage();
            return null;
        }
    }
    public function getIdByChemin($chemin) {
        try {
            $query = "SELECT idPhoto FROM photo WHERE image = :image";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":image", $chemin);
            $stmt->execute();
            $idPhoto = $stmt->fetchColumn();
    
            return $idPhoto;
        } catch (PDOException $e) {
            // Gérer l'erreur de base de données
            echo "Erreur lors de la récupération de l'ID de la photo : " . $e->getMessage();
            return null;
        }
    }
    public function getCheminImage($id) {
        // Préparez la requête SQL
        $query = "SELECT image FROM photo WHERE id = :id";
        
        $statement = $this->db->prepare($query);
        
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result['image'];
        } else {
            return false;
        }
    }

    public function getPhotosByProprieteId($idPropriete) {
        $query = "SELECT * FROM photo WHERE idProprio = :idPropriete";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':idPropriete', $idPropriete, PDO::PARAM_INT);
        $statement->execute();
        $photos = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            // Créer une instance de Photo avec les arguments requis
            $photo = new Photo($row['idPhoto'], $row['image'], $row['idProprio']);
            // Ajouter la photo à la liste des photos
            $photos[] = $photo;
        }
        return $photos;
    }
    public function modifierCheminImage($idPhoto, $nouveauChemin) {
        try {
            $query = "UPDATE photo SET image = :nouveauChemin WHERE idPhoto = :idPhoto";

            // Préparation de la requête
            $statement = $this->db->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $statement->bindParam(':nouveauChemin', $nouveauChemin, PDO::PARAM_STR);
            $statement->bindParam(':idPhoto', $idPhoto, PDO::PARAM_INT);

            // Exécution de la requête
            $resultat = $statement->execute();

            // Retourner true si la mise à jour a réussi, sinon false
            return $resultat;
        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            echo "Erreur lors de la mise à jour du chemin de l'image : " . $e->getMessage();
            return false;
        }
    }
    
    

}

?>
