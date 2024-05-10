<?php 
include 'views/template/header.php';
include 'manager/UtilisateurManager.php';
include 'manager/ProprieteManager.php';
include 'manager/PhotoManager.php';

?>

<div class="monCompte-bg">
    <div class="side-bar">
        <a href="#mes-proprietes">mes proprietes</a>
        <a href="#mes-infos-compte">mes informations de compte</a>
        <a href="#securité">sécurité</a>
        <a href="index.php?action=deconnexion">me déconnecter</a>

    </div>
    <div class="MesProprietes" id= "mes-proprietes">
        <h2>Mes Propriétés</h2>
        <?php
        if (isset($_SESSION['id'])) {
            $idUtilisateur = $_SESSION['id'];
            $db = new Database();

            // Récupérez les propriétés de l'utilisateur en utilisant le ProprieteManager
            $photoManager = new PhotoManager($db);
            $proprieteManager = new ProprieteManager($db);
            $proprietes = $proprieteManager->getProprietesByUtilisateurId($idUtilisateur);

            if ($proprietes) {
                // Affichez les propriétés de l'utilisateur
                foreach ($proprietes as $propriete) {
                    // Récupérer toutes les photos de la propriété
                    $photos = $photoManager->getPhotosByProprieteId($propriete->getIdProprio());
                
                    // Afficher les photos avec des options pour choisir celle à modifier
                    foreach ($photos as $photo) {
                        echo "<div class='propriete-compte'>";
                        echo "<div class='photo-compte'>";
                        echo "<img src='" . $photo->getImage() . "' alt='Photo de la propriété'>";
                        echo "<div class='lien-imageUniquement'>";
                        // Lien pour modifier cette photo
                        echo "<a class ='lien-image-btn' href='index.php?action=ModificationImage&&idPropriete={$propriete->getIdProprio()}&idPhoto={$photo->getIdPhoto()}'>Modifier cette photo</a>";
                        echo "</div>"; // fermeture de div lien-imageUniquement
                        echo "</div>"; // fermeture de div photo-compte
                        echo "<div class='details-compte'>";
                        // Afficher les détails de la propriété
                        echo "<p>{$propriete->getNom()}</p>";
                        echo "<p>{$propriete->getDescription()}</p>";
                        echo "<p>Adresse: {$propriete->getAdresse()}</p>";
                        echo "<p>Prix : {$propriete->getTarif()}</p>";
                        echo "</div>"; // fermeture de div details-compte
                        echo "<div class='lien-compte'>";
                        // Lien pour modifier la propriété
                        echo "<a class='modif-propriete-btn' href='index.php?action=AfficherModifCompte&idProprio={$propriete->getIdProprio()}'>Modifier</a>";
                        // Lien pour supprimer la propriété
                        echo "<a class='supprime-propriete-btn' href='index.php?action=SupprimerPropriete&&idProprio={$propriete->getIdProprio()}'>Supprimer</a>";
                        echo "</div>"; // fermeture de div lien-compte
                        echo "</div>"; // fermeture de div propriete-compte
                        echo "<hr>";
                    }
                }
                
            } else {
                echo "Aucune propriété associée à cet utilisateur.";
            }
        } else {
            echo "Utilisateur non connecté.";
        }
        ?>
    </div>

    <div class="information-compte" id="mes-infos-compte">
        <h1>MON ESPACE COMPTE </h1>
        <?php
        
        if (isset($_SESSION['id'])) {
            $idUtilisateur = $_SESSION['id'];
            $db= new Database();
            $utilisateurManager = new UtilisateurManager($db);

            $utilisateur = $utilisateurManager->getUtilisateurById($idUtilisateur);

            if ($utilisateur) {
                echo "<p>Nom : {$utilisateur->getNom()}</p>";
                echo "<p>Prénom : {$utilisateur->getPrenom()}</p>";
                echo "<p>Email : {$utilisateur->getEmail()}</p>";
                echo "<a class ='lien-modifier-infos' href='index.php?action=AfficherModificationInfosUtilisateur&&idUtilisateur=".$idUtilisateur."'>Modifier</a>";
            } else {
                echo "Impossible de récupérer les informations de l'utilisateur.";
            }
        } else {
            echo "Utilisateur non connecté.";
        }
        ?>
    </div>
    <div class="securite-compte">
        <h1>CHANGER MON MOT DE PASSE</h1>
        <p>*******************</P>
        <a href="index.php?action=AfficherModificationMDP">Modifier </a>
    </div>
</div>
