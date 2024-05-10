<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=SF+Pro+Text:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="Styles/accueil.css">
    <link rel="stylesheet" href="Styles/nav.css">
    <link rel="stylesheet" href="Styles/propriete.css">
    <link rel="stylesheet" href="Styles/authentification.css">
    <link rel="stylesheet" href="Styles/reservation.css">
    <link rel="stylesheet" href="Styles/inscription.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Styles/compte.css">
    <link rel="stylesheet" href="Styles/insererProprio.css">
    <link rel="stylesheet" href="Styles/moderation.css">
    <link rel="stylesheet" href="Styles/avis.css">
    <script src="traitement/avis.js"></script>



    <title>Run-saison - votre plateforme de location </title>
</head>
<nav class="nav-bar">
    <img src="images/logo2.png" alt="image-logo" class="logo-img">
    <div class="nav-links" id="nav-links">
        <a href="index.php?action=showAccueilUtilisateur">Accueil</a>
        <a href="#presentation">À propos</a>
        <a href="index.php?action=AfficherLesProprietes">Nos locations</a>
        <a href="index.php?action=AfficherPublicationProprio">Publier une propriété</a>
        <?php
        session_start();
        if (isset($_SESSION['utilisateur'])) {
            echo '<a href="index.php?action=AfficherMonCompte">Mon compte</a>';
        } else {
            echo '<a href="index.php?action=AfficherConnexion">Se connecter</a>';
        }

        // Vérifier si l'utilisateur est un administrateur
        if (isset($_SESSION['id'])) {
            $db = new DataBase();
            $idUtilisateur = $_SESSION['id'];
            $sql = "SELECT admin FROM utilisateurs WHERE idUtilisateur = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $idUtilisateur, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && $row['admin'] == true) {
                echo '<a href="index.php?action=AfficherAdministrationGlobale">Administration</a>';
            }
        }
        ?>
    </div>
</nav>

<body>
