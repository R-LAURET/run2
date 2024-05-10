<?php
// Inclusion de l'en-tête de la page
include 'views/template/header.php';


$idUtilisateur = $_SESSION['id']; 


include 'manager/UtilisateurManager.php';
$db= new Database();

$UtilisateurManager = new UtilisateurManager($db);

$utilisateur = $UtilisateurManager->getUtilisateurById($idUtilisateur);

?>

<div class="conteneur-modification-infos-utilisateur">
    <div class="formulaire-conteneur-modification-infos">
        <?php
        if (isset($_GET['message'])&& $_GET['message'] == "successModifInfo"){
            echo '<div class="success">Vos informations ont bien été modifiées</div>';
        }elseif (isset($_GET['message'])&& $_GET['message']== "echecModifInfo"){
            echo '<div class="error">Vos informations n\'ont pas pu être modifiées</div>';
        }
        ?>
        <h1>Modification des information de compte </h1>
        <form method="post" action="index.php?action=ModifierInfosUtilisateur">
            <div class="formulaire-modification-infos">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Votre nom" value="<?php echo $utilisateur->getNom(); ?>">
            </div>
            <div class="formulaire-modification-infos">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" value="<?php echo $utilisateur->getPrenom(); ?>">
            </div>
            <div class="formulaire-modification-infos">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Votre email" value="<?php echo $utilisateur->getEmail(); ?>">
            </div>
            <div class="formulaire-modification-infos">
                <input type="submit" value="Enregistrer les modifications">
            </div>
        </form>
    </div>
</div>
