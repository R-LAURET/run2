<?php 
include 'views/template/header.php';
?>
<div class="back-modif-mdp">
    <div class="form-modif-mdp">
        <h2>Modification de Mot de Passe</h2>
        <form action="index.php?action=traiterNouveauMDP" method="post">
            <div class="form-group-mdp">
                <label for="verif-mdp-actuel">Mot de Passe Actuel</label>
                <input type="password" id="verif-mdp-actuel" name="verif-mdp-actuel" required>
            </div>
            <div class="form-group-mdp">
                <label for="new-mdp">Nouveau Mot de Passe</label>
                <input type="password" id="new-mdp" name="new-mdp" required>
            </div>
            <div class="form-group-mdp">
                <label for="confirm-mdp">Confirmer le Nouveau Mot de Passe</label>
                <input type="password" id="confirm-mdp" name="confirm-mdp" required>
            </div>
            <button type="submit" class="btn">Modifier le Mot de Passe</button>
        </form>
    </div>
</div>