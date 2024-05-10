<?php 
include 'views/template/header.php';
include 'manager/AvisManager.php';

$db = new Database();
$avisManager = new AvisManager($db);

$avisNonModere = $avisManager->getAvisNonModere();

?>

<div class="back-avis">
    <?php 
    // Vérifier si des avis non modérés ont été trouvés
    if ($avisNonModere) {
        // Afficher chaque avis
        foreach ($avisNonModere as $avis) {
    ?>
    <div class="ligne-avis">
        <div class="contenu-avis">
            <p><strong>Commentaire : </strong><?= $avis['commentaire'] ?></p>
            <p><strong>Écrit par </strong> <?= $avis['prenom_utilisateur'] . ' ' . $avis['nom_utilisateur'] ?></p>
            <p><strong>Date : </strong> <?= $avis['date'] ?></p>
            <p><strong>Note : </strong><?= $avis['note'] ?></p>
        </div>
        <div class="lien-decision">
            <a class="accepter" href="index.php?action=moderationAvis&&message=accepter&&idAvis=<?= $avis['idAvis'] ?>">Accepter</a>
            <a class="refuser" href="index.php?action=moderationAvis&&message=refuser&&idAvis=<?= $avis['idAvis'] ?>">Refuser</a>
        </div>
    </div>
    <?php 
        }
    } else {
        echo "<p>Aucun avis non modéré trouvé.</p>";
    }
    ?>
</div>

