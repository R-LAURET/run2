<?php

include('views/template/header.php');

$idUtilisateur = $_SESSION['id'];

if (!isset($_SESSION['id'])){
    header('location: index.php?action=AfficherConnexion');
    exit();
}

?>
<div class="back-inserer-proprio">
    <h2>Créer une propriété</h2>
    <form action="index.php?action=InsererProprio" method="post" enctype="multipart/form-data" class="formulaire-propriete">

        <div class="form-group">
            <label for="nom">Nom de la propriété :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" required>
        </div>
        <div class="form-group">
            <label for="nombreChambres">Nombre de chambres :</label>
            <input type="number" name="nombreChambres" id="nombreChambres" required min="0">
        </div>
        <div class="form-group">
            <label for="tarif">Tarif par nuit :</label>
            <input type="number" name="tarif" id="tarif" required min="0">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label class="file-label" for="image">Déposer votre photo</label>
            <input type="file" name="image" id="image" accept="image/*" >
        </div>
        <input type="hidden" name="idUtilisateur" value="<?php echo $idUtilisateur; ?>">
        <div class="form-group">
            <input type="submit" value="Créer la propriété">
        </div>
    </form>
</div>
