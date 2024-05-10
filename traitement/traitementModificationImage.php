<?php
include 'manager/PhotoManager.php';
$db = new Database();
$photoManager = new PhotoManager($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["idPropriete"]) && isset($_POST["idPhoto"]) && isset($_FILES["nouvelleImage"])) {
        $idPropriete = $_POST["idPropriete"];
        $idPhoto = $_POST["idPhoto"];

        $imageTmpName = $_FILES["nouvelleImage"]["tmp_name"];
        $imageName = basename($_FILES["nouvelleImage"]["name"]);

        $uploadDirectory = "imageProprio/";

        $newImageName = uniqid() . '_' . $imageName;
        $uploadPath = $uploadDirectory . $newImageName;

        if(move_uploaded_file($imageTmpName, $uploadPath)){
            $db = new Database();
            $photoManager = new PhotoManager($db);
            $resultatMiseAJour = $photoManager->modifierCheminImage($idPhoto, $uploadPath);

            if ($resultatMiseAJour) {
                header('Location: index.php?action=AfficherMonCompte&&message=success');
                exit();
            } else {
                // Redirection avec un message d'échec
                header('Location: index.php?action=AfficherMonCompte&&message=error');
                exit();
            }
        } else {
            // Redirection avec un message d'erreur
            header('Location: index.php?action=AfficherMonCompte&&message=Error');
            exit();
        }
    } else {
        // Redirection avec un message d'erreur si des données sont manquantes
        header('Location: index.php?action=AfficherMonCompte&&message=error');
        exit();
    }
} else {
    // Redirection avec un message d'erreur si la méthode HTTP est invalide
    header('Location: index.php?action=AfficherModificationImageError');
    exit();
}
?>
