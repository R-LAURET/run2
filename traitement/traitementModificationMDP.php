<?php
session_start();
$idUtilisateur= $_SESSION['id'];
include 'manager/UtilisateurManager.php';
$db= new Database();
$utilisateur = new UtilisateurManager($db);



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mdpActuel= $_POST['verif-mdp-actuel'];
        $nouveauMdp =$_POST['new-mdp'];
        $confirmMdp= $_POST['confirm-mdp'];
        

        if(!empty($mdpActuel) && !empty ($nouveauMdp) && !empty($confirmMdp) ){
            $resultat = $utilisateur -> modifierMDP($mdpActuel,$nouveauMdp,$confirmMdp,$idUtilisateur); 
            if($resultat){
                header('location: index.php?action=AfficherMonCompte&&message=ModifMdpSuccess');
                exit();
            }else{
                header('location: index.php?action=AfficherMonCompte&&message=ModifMdpEchec');
                exit();
            }
        }
    } else {
    header("Location: index.php?action=AfficherMonCompte&&message=ModifMdpEchec2");
    exit();
    }
?>