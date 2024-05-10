<?php
include 'views/template/header.php';
?>
<div class="conteneur-inscription">
    <div class="formulaire-conteneur-inscription">
        <h1>Inscription</h1>
        <form method="post" action="index.php?action=InscriptionUtilisateur">
            <div class="formulaire-inscription">
                <label for="nom">nom</label>
                <input type="text" name="nom" id="nom" placeholder="votre nom">
            </div>
            <div class="formulaire-inscription">
                <label for="prenom">prenom</label>
                <input type="text" name="prenom" id="prenom" placeholder="votre prenom">
            </div>
            <div class="formulaire-inscription">
                <label for="age">age</label>
                <input type="number" name="age" id="age" placeholder="votre age">
            </div>
            <div class="formulaire-inscription">
                <label for="email">email</label>
                <input type="email" name="email" id="email" placeholder="votre email">
            </div>
            <div class="formulaire-inscription">
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="votre mot de passe">
            </div>
            <div class="formulaire-inscription">
                <input type="submit" value="Se connecter">
            </div>
        </form>
    
    </div>
</div>