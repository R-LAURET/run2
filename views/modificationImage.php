<?php
include 'views/template/header.php';
include 'manager/PhotoManager.php';
include 'manager/ProprieteManager.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["idPropriete"]) && isset($_GET["idPhoto"])) {
        $idPropriete = $_GET["idPropriete"];
        $idPhoto = $_GET["idPhoto"];

        $db = new Database();
        $proprieteManager = new ProprieteManager($db);
        $photoManager = new PhotoManager($db);

        $propriete = $proprieteManager->getProprieteById($idPropriete);
        $photo = $photoManager->getPhotoById($idPhoto);

        // Vérification si la propriété et la photo existent
        if($propriete && $photo) {
?>
            <div class="backModifImage">
                    <h2>Modification de l'image de la propriété : <?= $propriete->getNom() ?></h2>
                        <div class="image-modifier">
                            <img src="<?= $photo->getImage() ?>" alt="Image de la propriété">
                        </div>
                        <div class="formulaire-modification-image">
                            <!-- Formulaire de téléchargement de la nouvelle image -->
                            <form method="post" action="index.php?action=ModifierImageProprio" enctype="multipart/form-data">
                                <input type="hidden" name="idPropriete" value="<?= $idPropriete ?>">
                                <input type="hidden" name="idPhoto" value="<?= $idPhoto ?>">
                                <input type="file" name="nouvelleImage" accept="image/*" required>
                                <input type="submit" value="Télécharger">
                            </form>
                        </div>
            </div>
<?php
        } else {
            echo "Propriété ou photo non trouvée.";
        }
    } else {
        echo "Paramètres manquants.";
    }
} else {
    echo "Méthode HTTP invalide.";
}
?>
