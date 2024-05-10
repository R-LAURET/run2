<?php

include_once "views/template/header.php";
$db = new Database();
include 'manager/proprieteManager.php';
$proprieteManager = new ProprieteManager($db);

if (isset($_GET['id'])) {
    $idProprio = $_GET['id'];

    // Récupération des propriete
    $propriete = $proprieteManager->getProprieteById($idProprio); 
    
    // Vérifiez si la propriété a été trouvée
    if ($propriete !== null) {
    ?>  <div class="propriete-conteneur"><?php
        ?>  <div class="photo"><?php
                $imagePath = $proprieteManager->getProprieteImage($idProprio);
                if ($imagePath !== null) {
                    echo '<img src="'.$imagePath.'" alt="Image propriété">';
                } else {
                    echo '<p>Aucune photo disponible</p>';
                }
        ?>  </div>
        <div class="informations"><?php
            echo "<h2>Détails de la propriété :</h2>";
            echo "<p>Nom : " . $propriete->getNom() . "</p>";
            echo "<p>Adresse : " . $propriete->getAdresse() . "</p>";
            echo "<p>Nombre de chambres : " . $propriete->getNombreChambre() . "</p>";
            echo "<p>Tarif par nuit : " . $propriete->getTarif() . " 
            euros</p>";
            echo "<h2>Description de la propriété</h2>"; 
            echo "<p> " . $propriete->getDescription() . "</p>";
            ?>
            <div class="lien">
                <a href="index.php?action=AfficherReservation&id=<?php echo $idProprio; ?>">Réserver</a>
            </div>
            <?php
            ?></div><?php

        
        ?></div> <?php
    } else {
        // Si la propriété n'est pas trouvée, afficher un message d'erreur
        echo "<p>La propriété n'a pas été trouvée.</p>";
    }
} else {
    // Si l'ID de la propriété n'est pas fourni, afficher un message d'erreur
    echo "<p>Identifiant de propriété non fourni.</p>";
}
?>
