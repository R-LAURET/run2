<?php 
include 'manager/proprieteManager.php';
$db= new DataBase();
$proprieteManager = new ProprieteManager($db);

if (isset($_GET['idProprio'])){
    $idProprio = $_GET['idProprio'];

    $proprieteSupprimer = $proprieteManager->SupprimerPropriete($idProprio);


    if ($proprieteSupprimer){
        header('Location: index.php?action=AfficherMonCompte&&message=SuppressionAvecSucess');
    }else{
        header('Location: index.php?action=AfficherMonCompte&&message=SuppressionEchec');
    }
}