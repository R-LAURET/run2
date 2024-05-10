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

    public function modifierMDP($mdpActuel,$nouveauMdp,$confirmMdp,$idUtilisateur){

        $sqlMdpActuel = "SELECT mdp FROM utilisateurs WHERE idUtilisateur = :idUtilisateur";
    
        $requete = $this->db->prepare($sqlMdpActuel);

        $requete->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);

        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return false;
        }
        if (!password_verify($mdpActuel, $resultat['mdp'])) {
            return false;
        }
        if ($nouveauMdp !== $confirmMdp) {
            return false;
        }

        $nouveauMdpHash = password_hash($nouveauMdp, PASSWORD_DEFAULT);

        $sqlUpdateMdp = "UPDATE utilisateurs SET mdp = :nouveauMdp WHERE idUtilisateur = :idUtilisateur";
    
        $requeteUpdate = $this->db->prepare($sqlUpdateMdp);
    
        $requeteUpdate->bindParam(':nouveauMdp', $nouveauMdpHash);
        $requeteUpdate->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    
        if ($requeteUpdate->execute()) {
            return true;
        } else {
            return false;
        }


    
    }

    public function modifierInformationCompte($idUtilisateur, $nom, $prenom, $email){
        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email WHERE idUtilisateur = :idUtilisateur";
        $stmt =  $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    
        $resultat= $stmt->execute();
    
        if($resultat){
            return true;
        }else{
            return false;
        }
    }
    
}
?>
