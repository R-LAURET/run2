<?php
include_once "views/template/header.php";
$db = new Database();
include 'manager/proprieteManager.php';
include 'manager/AvisManager.php';
$proprieteManager = new ProprieteManager($db);

if (isset($_GET['id'])) {
    $_SESSION['idPropriete'] = $_GET['id'];
    $idProprio = $_SESSION['idPropriete'];

    // Récupération des propriete
    $propriete = $proprieteManager->getProprieteById($idProprio); 
    
    // Vérifiez si la propriété a été trouvée
    if ($propriete !== null) {
?>
<div class="propriete-conteneur">
    <div class="contient-photo-infos">
        <div class="photo">
            <?php
            $imagePath = $proprieteManager->getProprieteImage($idProprio);
            if ($imagePath !== null) {
                echo '<img src="'.$imagePath.'" alt="Image propriété">';
            } else {
                echo '<p>Aucune photo disponible</p>';
            }
            ?>
        </div>
        <div class="informations">
            <h2>Détails de la propriété :</h2>
            <p>Nom : <?php echo $propriete->getNom(); ?></p>
            <p>Adresse : <?php echo $propriete->getAdresse(); ?></p>
            <p>Nombre de chambres : <?php echo $propriete->getNombreChambre(); ?></p>
            <p>Tarif par nuit : <?php echo $propriete->getTarif(); ?> euros</p>
            <h2>Description de la propriété</h2>
            <p><?php echo $propriete->getDescription(); ?></p>
            <div class="lien">
                <a href="index.php?action=AfficherReservation&id=<?php echo $idProprio; ?>">Réserver</a>
            </div>
        </div>
    </div>
    <div class="avis-propriete">
        <div class="propriete-avis-ligne">
            <h1>Avis de la propiete </h1>
            <?php
                // Récupérer les avis de la propriété à l'aide de la méthode getAvisByProprieteId de votre AvisManager
                $avisManager = new AvisManager($db);
                $avis = $avisManager->getAvisByProprieteId($propriete->getIdProprio());
                
            
                // Afficher les avis sur la propriété avec les informations de l'utilisateur
                if ($avis) {
                    foreach ($avis as $avisInfo) {
                        echo '<p class="nom" > ' . $avisInfo['nom'] ." ".$avisInfo['prenom'].'</p>';
                        echo '<p>Commentaire: ' . $avisInfo['commentaire'] . '</p>';
                        echo '<p>publié le : ' . $avisInfo['date'] . '</p>';
                        echo '<div class="rating">';
                        // Afficher les étoiles en fonction de la note
                        $note = $avisInfo['note'];
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $note) {
                                echo '<span class="star fas fa-star"></span>';
                            } else {
                                echo '<span class="star far fa-star"></span>';
                            }
                        }
                        echo '</div>';
                        echo '<hr>';
                    }
                } else {
                    echo '<p>Aucun avis disponible pour cette propriété.</p>';
                }
            ?>
        </div>
        <div class="lien-donner-avis">
            <a href="index.php?action=AfficherInsererAvis"> Donnez mon avis </a>
        </div>
    </div>
</div>
<?php
    } else {
        // Si la propriété n'est pas trouvée, afficher un message d'erreur
        echo "<p>La propriété n'a pas été trouvée.</p>";
    }
} else {
    // Si l'ID de la propriété n'est pas fourni, afficher un message d'erreur
    echo "<p>Identifiant de propriété non fourni.</p>";
}
?>
