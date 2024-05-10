<?php include 'views/template/header.php'; ?>

<div class="conteneur-connexion">
    <div class="formulaire-conteneur">
        <h1>Connexion</h1>
        <div class="error">
            <?php
            if (isset($_GET['message'])) {
                echo $_GET['message'];
            }
           ?>
        </div>
        <form method="post" action="index.php?action=ConnecterUtilisateur">
            <div class="formulaire">
                <label for="email">email</label>
                <input type="email" name="email" id="email" placeholder="votre email">
            </div>
            <div class="formulaire">
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="votre mot de passe">
            </div>
            <div class="formulaire">
                <input type="submit" value="Se connecter">
            </div>
            <a href="index.php?action=AfficherInscription"> s'inscrire?</a>
        </form>
    
    </div>
</div>