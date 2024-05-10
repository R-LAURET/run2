<?php
include_once 'models/Utilisateur.php'; 

class UtilisateurManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUtilisateurById($id) {
        // Préparez votre requête SQL pour récupérer un utilisateur par son ID
        $query = "SELECT * FROM utilisateurs WHERE idUtilisateur = :id";

        // Préparez la requête
        $statement = $this->db->prepare($query);

        // Liaison des paramètres
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécutez la requête
        $statement->execute();

        // Récupérer le résultat sous forme de tableau associatif
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si une ligne a été trouvée
        if ($row) {
            // Créez un objet Utilisateur à partir des données récupérées
            $utilisateur = new Utilisateur($row['idUtilisateur'], $row['nom'], $row['prenom'], $row['email'], $row['mdp'],$row['admin']);
            return $utilisateur; 
        } else {
            return null; 
        }
    }
}
?>
