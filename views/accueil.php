<?php 
include 'views/template/header.php';
?>

<div class="accueil-bg">
    <div class="bande">
        <div class="image">
            <img src="images/1.jpg" alt="bande">
        </div>
        <div class="cta">
            <h1>RUN-SAISON</h1>
            <h2>Votre plateforme de location saisonière</h2>
            <p>Découvrez La Réunion comme jamais auparavant grâce à notre site qui vous offre un large éventail de locations saisonnières, allant des villas luxueuses aux charmants bungalows en bord de mer.</p>
            <a href="index.php?action=AfficherLesProprietes" class="btn btn-primary">Trouver une propriété</a>
        </div>
    </div>
    <?php include 'vuePropriete.php'; ?>
</div>
