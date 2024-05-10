<?php
$database = new Database();
$controller= new Controller($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $age = htmlspecialchars($_POST['age']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);

    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

    if (preg_match($regex, $mdp)) {
       
        $success = $controller->createUser($nom, $prenom, $age, $email, $mdp);

    }

    if ($success) {
        header("location:index.php?action=AfficherInscription&message=Inscription%20réussie.");

    } else {
        header("location:index.php?action=AfficherInscription&&message=Le%20mot%20de%20passe%20doit%20contenir%20au%20moins%20une%20lettre%20minuscule,%20une%20lettre%20majuscule,%20un%20chiffre%20et%20avoir%20une%20longueur%20d'au%20moins%208%20caractères.");
    }
}
?>