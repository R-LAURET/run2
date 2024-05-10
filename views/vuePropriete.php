<?php
include 'manager/ProprieteManager.php';
require_once 'models/Database.php';
$db = new Database();
$proprieteManager = new ProprieteManager($db);

// Récupérer les 4 premières propriétés depuis la base de données
$limitedProprietes = array_slice($proprieteManager->getAllProprietes(), 0, 4);
?>
<div class="propriete-cartes-container">
    <div class="propriete-cartes">
        <div class="cartes">
            <?php foreach ($limitedProprietes as $propriete): ?>
                <div class="propriete-carte">
                    <div class="propriete-carte-image">
                        <?php
                        // Récupère le chemin de l'image de la propriété actuelle
                        $imagePath = $proprieteManager->getProprieteImage($propriete->getIdProprio());
                        // Vérifie si un chemin d'image a été trouvé
                        if ($imagePath !== null) {
                            // Affiche l'image en utilisant le chemin
                            echo '<img src="'.$imagePath.'" alt="Image propriété">';
                        } else {
                            // Affiche un message si aucun chemin d'image n'a été trouvé
                            echo '<p>Aucune photo disponible</p>';
                        }
                        ?>
                    </div>
                    <div class="propriete-carte-text">
                        <h3><?php echo $propriete->getNom(); ?></h3>
                        <p class="description-proprio-carte"><?php echo $propriete->getDescription(); ?></p>
                        <!-- Ajoutez d'autres informations sur la propriété si nécessaire -->
                        <a class="propriete-lien" href="index.php?id=<?php echo $propriete->getIdProprio(); ?>&action=AfficherUnePropriete">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>