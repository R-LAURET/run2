<?php
include 'manager/utilisateurManager.php';
$db= new Database();
$utilisateurManager = new utilisateurManager($db);

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idUtilisateur = $_SESSION['id']; 
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];

    $resultat = $utilisateurManager->modifierInformationCompte($idUtilisateur, $nom, $prenom, $email);

    if ($resultat){
        header("Location: index.php?action=AfficherModificationInfosUtilisateur&&message=successModifInfo");
        exit();
    }else{
        header("Location: index.php?action=AfficherModificationInfosUtilisateur&&message=echecModifInfo");
        exit();
    }


} else{
    header("Location: page_de_modification.php?aero");
    exit();
}
?>