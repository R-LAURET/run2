<?php

$db= new Database();
$controlleur= new Controller($db);

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_propriete = $_SESSION['idProprio']; 
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $adresse = $_POST["adresse"];
    $nombreChambre = $_POST["nombreChambre"];
    $tarif = $_POST["tarif"];

    // Appel de la fonction pour modifier la propriété
    $controlleur->modifierPropriete($id_propriete, $nom, $description, $adresse, $nombreChambre, $tarif);
} else {
    header("Location: page_de_modification.php");
    exit();
}
?>
