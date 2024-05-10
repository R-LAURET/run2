<?php
// Inclusion de l'en-tête de la page
include 'views/template/header.php';


$idPropriete = $_GET['id']; 
$_SESSION['idProprio']= $idPropriete;

include 'manager/ProprieteManager.php';
$db= new Database();

$ProprieteManager = new ProprieteManager($db);



$propriete = $ProprieteManager->getProprieteById($idPropriete);

?>

<div class="conteneur-modification">
    <div class="formulaire-conteneur-modification">
        <h1>Modification des propriétés</h1>
        <form method="post" action="index.php?action=ModifierCompte">
            <div class="formulaire-modification">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Votre nom" value="<?php echo $propriete->getNom(); ?>">
            </div>
            <div class="formulaire-modification">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Description de la propriété"><?php echo $propriete->getDescription(); ?></textarea>
            </div>
            <div class="formulaire-modification">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" placeholder="Adresse de la propriété" value="<?php echo $propriete->getAdresse(); ?>">
            </div>
            <div class="formulaire-modification">
                <label for="nombreChambre">Nombre de chambres</label>
                <input type="number" name="nombreChambre" id="nombreChambre" placeholder="Nombre de chambres" value="<?php echo $propriete->getNombreChambre(); ?>">
            </div>
            <div class="formulaire-modification">
                <label for="tarif">Tarif</label>
                <input type="number" name="tarif" id="tarif" placeholder="Tarif par nuit" value="<?php echo $propriete->getTarif(); ?>">
            </div>
            <div class="formulaire-modification">
                <input type="submit" value="Enregistrer les modifications">
            </div>
        </form>
    </div>
</div>

