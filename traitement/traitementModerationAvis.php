<?php 
include 'manager/AvisManager.php';
$db = new Database();
$avisManager = new AvisManager($db);

$idAvis = $_GET['idAvis'];

if (isset($_GET['message']) && $_GET['message']=='accepter'){
    $resultat= $avisManager->accepterAvis($idAvis);
    if($resultat){
        header('location:index.php?action=AfficherAdministrationGlobale&&message=modifierAvisSuccess');
        exit();
    }else{
        header('location:index.php?action=AfficherAdministrationGlobale&&message=modifierAvisEchec');
        exit();
    }
    
} elseif (isset($_GET['message']) && $_GET['message']=='refuser') {
    $resultat = $avisManager->refuserAvis($idAvis);
    if ($resultat){
        header('location:index.php?action=AfficherAdministrationGlobale&&message=refusAvisSuccess');
        exit();
    }
} else {
    echo "Message d'action non spécifié.";
}
?>
