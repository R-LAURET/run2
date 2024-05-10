<?php

class Controller {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }
    private function Connecter($email, $mdp) {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $params = array(':email' => $email);
        $resultat = $this->database->executer($sql, $params);
        $utilisateur = $resultat->fetch(PDO::FETCH_ASSOC);
    
        if ($utilisateur) {
            // Utilisation de password_verify pour vérifier le mot de passe
            if (password_verify($mdp, $utilisateur['mdp'])) {
                session_start();
                $_SESSION['utilisateur'] = $utilisateur;
                $_SESSION['id'] = $utilisateur['idUtilisateur'];
                return $utilisateur;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function createUser($nom, $prenom, $age, $email, $mdp) {

        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO utilisateurs (nom, prenom, age, email, mdp) VALUES (:nom, :prenom, :age, :email, :mdp)";
        $params = array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':age' => $age,
            ':email' => $email,
            ':mdp' => $hashedPassword
        );
        
        $resultat = $this->database->executer($sql, $params);
        
        return $resultat;
    }

    function modifierPropriete($id, $nom, $description, $adresse, $nombreChambre, $tarif) {
        
        try {
    
            // Mise à jour des données dans la base de données
            $sql = "UPDATE propriete SET nom = :nom, description = :description, adresse = :adresse, nombreChambre = :nombreChambre, tarif = :tarif WHERE idProprio = :id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':nombreChambre', $nombreChambre);
            $stmt->bindParam(':tarif', $tarif);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            // Redirection vers une page de succès ou affichage d'un message de succès
            header("Location: index.php?action=AfficherMonCompte&&message=sucess");
            exit();
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de la modification de la propriété: " . $e->getMessage();
        }
    }

    public function handleRequest() {
        // Récupérer l'action à partir de la requête utilisateur
        $action = isset($_GET['action']) ? $_GET['action'] : 'AfficherAccueil';

        // Exécuter l'action appropriée
        switch ($action) {
            case 'AfficherAccueil':
                $this->AfficherAccueil();
                break;
            case 'AfficherAccueilUtilisateur':
                $this->AfficherAccueilUtilisateur();
                break;
            case 'AfficherUnePropriete':
                $this->AfficherUnePropriete();
                break;
            case 'AfficherConnexion':
                $this->AfficherConnexion();
                break;
            case 'AfficherInscription':
                $this->AfficherInscription();
                break;
            case 'InscriptionUtilisateur':
                $this->InscriptionUtilisateur();
                break;
            case 'ConnecterUtilisateur':
                $this->ConnecterUtilisateur();
                break;
            case 'AfficherLesProprietes':
                $this->AfficherLesPropriete();
                break;
            case 'AfficherReservation':
                $this->AfficherReservation();
                break;
            case 'TraiterReservation':
                $this->TraiterReservation();
                break;
            case 'AfficherMonCompte':
                $this->AfficherMonCompte();
                break;
            case 'AfficherModifCompte':
                $this->AfficherModifCompte();
                break;
            case 'ModifierCompte':
                $this->ModifierCompte();
                break;
            case 'AfficherPublicationProprio':
                $this->CreerPropriete();
                break;
            case 'InsererProprio':
                $this->InsererProprio();
                break;
            case 'ModificationImage':
                $this->ModificationImage();
                break;
            case 'ModifierImageProprio':
                $this->ModifierImageProprio();
                break;
            case 'SupprimerPropriete':
                $this->SupprimerPropriete();
                break;
            case 'AfficherAdministrationGlobale':
                $this->AfficherAdministrationGlobale();
                break;
            case 'AfficherModerationAvis':
                $this->AfficherModerationAvis();
                break;
            case 'moderationAvis':
                $this->moderationAvis();
                break;
            case 'AfficherModificationInfosUtilisateur':
                $this->AfficherModificationInfosUtilisateur();
                break;
            case 'ModifierInfosUtilisateur':
                $this->ModifierInfosUtilisateur();
                break;
            case'AfficherModificationMDP':
                $this->AfficherModificationMDP();
                break;
            case 'traiterNouveauMDP':
                $this->traiterNouveauMDP();
                break;
            case'AfficherInsererAvis':
                $this->AfficherInsererAvis();
                break;
            case 'deconnexion':
                session_start();
                session_destroy();
                header("Location: index.php?action=AfficherAccueil");
                exit(); 
                break;
            case 'insererAvis':
                $this->insererAvis();
                break;
            case 'AfficherReservationAdmin':
                $this->AfficherReservationAdmin();
                break;
            case 'ReservationModifAdmin':
                $this->ReservationModifAdmin();
                break;
            default:
                $this->AfficherAccueil();
                break;
        }
    }

    // Méthodes pour chaque action

    private function AfficherAccueil() {
        include 'views/accueil.php';
    }
    private function AfficherAccueilUtilisateur() {
        include 'views/accueilUtilisateur.php';
    }
    private function AfficherUnePropriete() {
        include 'views/voirPlusPropriete.php';
    }
    private function AfficherConnexion() {
        include 'views/connexion.php';
    }
    private function AfficherInscription() {
        include 'views/inscription.php';
    }
    private function InscriptionUtilisateur() {
        include 'traitement/traitementInscription.php';
    }
    private function ConnecterUtilisateur() {
        include 'traitement/traitementConnexion.php';
    }
    private function AfficherLesPropriete() {
        include 'views/VueDesProprietes.php';
    }
    private function AfficherReservation() {
        include 'views/vueReservation.php';
    }
    private function TraiterReservation() {
        include 'traitement/traitementReservation.php';
    }
    private function AfficherMonCompte() {
        include 'views/vueMonCompte.php';
    }
    private function AfficherModifCompte() {
        include 'views/modificationCompte.php';
    }
    private function ModifierCompte() {
        include 'traitement/traitementModification.php';
    }
    private function CreerPropriete() {
        include 'views/vueCreerPropriete.php';
    }
    private function InsererProprio() {
        include 'traitement/traitementPropriete.php';
    }
    private function ModificationImage() {
        include 'views/modificationImage.php';
    }
    private function ModifierImageProprio() {
        include 'traitement/traitementModificationImage.php';
    }
    private function AfficherAdministrationGlobale() {
        include 'views/AdministrationGlobale.php';
    }
    private function AfficherModerationAvis() {
        include 'views/moderationAvis.php';
    }
    private function moderationAvis() {
        include 'traitement/traitementModerationAvis.php';
    }
    private function SupprimerPropriete() {
        include 'traitement/traitementSupprimerPropriete.php';
    }
    private function AfficherModificationInfosUtilisateur() {
        include 'views/modificationInfosUtilisateur.php';
    }
    private function ModifierInfosUtilisateur() {
        include 'traitement/traitementModificationInfosUtilisateur.php';
    }
    private function AfficherModificationMDP() {
        include 'views/modificationMDP.php';
    }
    private function traiterNouveauMDP() {
        include 'traitement/traitementModificationMDP.php';
    }
    private function AfficherInsererAvis(){
        include 'views/insererAvis.php';
    }
    private function insererAvis(){
        include 'traitement/traitementInsererAvis.php';
    }
    private function AfficherReservationAdmin (){
        include 'views/reservationAdmin.php';
    }
    private function ReservationModifAdmin (){
        include 'views/ReservationModifAdmin.php';
    }

}   
?>
