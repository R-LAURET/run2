<?php 
include 'views/template/header.php';

include 'manager/proprieteManager.php';
$db = new Database();
$proprieteManager = new ProprieteManager($db);
$idPropriete= $_SESSION['idPropriete'];

?>

<div class="back-donner-avis">
    <div class="photo-donner-avis">
        <img src="<?php echo $proprieteManager->getProprieteImage($idPropriete);?>" alt="photo de la propriete ">
    </div>
    <div class="donner-avis">
        <div class="formulaire-container-avis">
            <form action="index.php?action=insererAvis" method="POST">
                <div class="formulaire-notation">
                    <label for="commentaire">Votre commentaire:</label>
                    <textarea name="commentaire" id="commentaire" placeholder="Votre commentaire"></textarea>
                </div>
                <div class="formulaire-notation">
                    <label for="note">Votre note sur 5:</label>
                    <input type="number" name="note" id="noteInput" placeholder="Votre note" min="1" max="5">
                </div>
                <div class="note">
                    <i class="star" data-star="1">&#9733;</i>
                    <i class="star" data-star="2">&#9733;</i>
                    <i class="star" data-star="3">&#9733;</i>
                    <i class="star" data-star="4">&#9733;</i>
                    <i class="star" data-star="5">&#9733;</i>
                </div>
                <button class="envoyer-avis" type="submit">Envoyer</button>
            </form>
            <div class="resultat-insertion-avis">
                <?php 
                if (isset($_GET['message']) && $_GET['message'] == 'successAvis'){
                    echo '<p class="sucessAvis">Votre avis est en cours de modération et sera publier dans les plus brève délaie</p>';
                }elseif(isset($_GET['message']) && $_GET['message']=='echecAvis'){
                    echo '<p class="echecAvis">Une erreur est survenue lors de l\'envoi de votre avis</p>';
                }elseif(isset($_GET['message'])&& $_GET['message']=='limiteAvis'){
                    echo '<p class="echecAvis">Vous avez atteint le nombre maximal d\'avis sur cette propriété</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll('.star');
    const noteInput = document.getElementById('noteInput');

    noteInput.addEventListener('change', function() {
        const rating = parseInt(noteInput.value);

        stars.forEach(star => {
            const starRating = parseInt(star.getAttribute('data-star'));
            if (starRating <= rating) {
                star.style.color = '#ffc400';
            } else {
                star.style.color = 'black';
            }
        });
    });
});
</script>






