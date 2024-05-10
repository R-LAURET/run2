<?php
include 'manager/ProprieteManager.php';
include 'manager/AvisManager.php';

$database = new Database();
$proprieteManager = new ProprieteManager($database);
$controller = new Controller($database);

$proprietes = $proprieteManager->getAllProprietes();

include 'views/template/header.php';
?>

<div class="Proprietes-bg">
    <?php foreach ($proprietes as $propriete) : ?>
        <div class="propriete">
            <div class="photo-proprietes">
                <!-- Afficher la photo de la propriété -->
                <?php
                // Récupérer l'image de la propriété à l'aide de la fonction getProprieteImage
                $image = $proprieteManager->getProprieteImage($propriete->getIdProprio()); 
                if ($image) {
                    echo '<img src="' . $image . '" alt="Photo de la propriété">';
                } else {
                    echo '<p>Aucune image disponible</p>';
                }
                ?>
            </div>
            <div class="description">
                <h2><?php echo $propriete->nom; ?></h2>
                <p>adresse :<?php echo $propriete->adresse; ?></p>
                <p>nombre de chambre : <?php echo $propriete->nombreChambre; ?></p>
                <p>Prix: <?php echo $propriete->tarif; ?></p>
                <div class="lienDesProprietes">
                    <a href="index.php?action=AfficherUnePropriete&&id=<?php echo $propriete->getIdProprio(); ?>">Voir la propriété</a>
                </div>
            </div>
            <div class="avis">
    <!-- Afficher les avis sur la propriété -->
    <?php
    // Récupérer les avis de la propriété à l'aide de la méthode getAvisByProprieteId de votre AvisManager
    $avisManager = new AvisManager($database);
    $avis = $avisManager->getAvisByProprieteId($propriete->getIdProprio());

    // Afficher les avis sur la propriété avec les informations de l'utilisateur
    if ($avis) {
        echo '<h3>Avis </h3>';
        foreach ($avis as $avisInfo) {
            echo '<p class="nom" > ' . $avisInfo['nom'] ." ".$avisInfo['prenom'].'</p>';
            echo '<p>Commentaire: ' . $avisInfo['commentaire'] . '</p>';
            echo '<p>publié le : ' . $avisInfo['date'] . '</p>';
            echo '<div class="rating">';
            // Afficher les étoiles en fonction de la note
            $note = $avisInfo['note'];
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $note) {
                    echo '<span class="star fas fa-star"></span>';
                } else {
                    echo '<span class="star far fa-star"></span>';
                }
            }
            echo '</div>';
            echo '<hr>';
        }
    } else {
        echo '<p>Aucun avis disponible pour cette propriété.</p>';
    }
    ?>
</div>


        </div>
    <?php endforeach; ?>
</div>


