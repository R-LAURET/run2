<?php

include 'manager/ProprieteManager.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $chambre = $_POST["nombreChambres"];
    $tarif = $_POST["tarif"];
    $description = $_POST["description"];  
    $idUtilisateur = $_POST["idUtilisateur"];

    // Vérifier si des données d'image ont été envoyées
    if (!empty($_FILES["image"])) {
        // Chemin vers le dossier où les images seront sauvegardées
        $uploadDirectory = "imageProprio/";

        // Générer un nom de fichier unique
        $imageName = uniqid() . '_' . basename($_FILES["image"]["name"]);
        $uploadPath = $uploadDirectory . $imageName;
        $imageTmpName = $_FILES["image"]["tmp_name"];

        // Déplacer le fichier téléchargé vers le dossier de destination
        if(move_uploaded_file($imageTmpName, $uploadPath)){
            // Si le téléchargement d'image réussit, insérer les données dans la base de données
            $db = new DataBase();
            $proprieteManager = new ProprieteManager($db);
            $resultatPropriete = $proprieteManager->insererPropriete($idUtilisateur, $nom, $adresse, $description, $chambre, $tarif, $uploadPath);
            if ($resultatPropriete){
                header('Location: index.php?action=AfficherPublicationProprio&&message=success');
                exit();
            } else {
                header('Location: index.php?action=AfficherPublicationProprio&&message=echec');
                exit();
            }
        } else {
            // Si le téléchargement d'image échoue, rediriger avec un message d'erreur
            header('Location: index.php?action=AfficherPublicationProprio&&message=erreur_image');
            exit();
        }
    } else {
        // Si aucune image n'a été envoyée, rediriger avec un message d'erreur
        header('Location: index.php?action=AfficherPublicationProprio&&message=aucune_image');
        exit();
    }
}



?>