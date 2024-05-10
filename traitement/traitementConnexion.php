<?php



// Création de l'instance de la base de données et du contrôleur
$database = new Database();
$controller = new Controller($database);

// Vérification de la soumission du formulaire
if (isset($_POST["email"]) && isset($_POST["mdp"])) {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    
    // Appel de la méthode de connexion du contrôleur
    $connexion = $controller->Connecter($email, $mdp);
    if ($connexion) {
        // Redirection avec un message de succès
        header("location:index.php?action=AfficherAccueil&message=success");
        exit();
    } else {
        // Redirection avec un message d'erreur
        header("location:index.php?action=AfficherConnexion&message=informations de connexion éronné");
        exit();
    }
} else {
    // Redirection avec un message d'erreur si les champs ne sont pas définis
    header("location:index.php?action=AfficherConnexion&message=error");
    exit();
}
?>
