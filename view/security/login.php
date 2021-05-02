<?php

if(App\Session::getUser())
{
    echo "<h2>Vous êtes déjà connecter</h2>";
}

?>

<section class="form-container">
    <form action="index.php?ctrl=security&method=login" method="POST">
        <h2 class="text-center text-white my-3">Connectez-vous!</h2>


        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Entrez votre email" disabled required>
        </div>

        <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" disabled required>
        </div>

        <input type="hidden" name="token" value="<?=$token?>">


        <button type="submit" class="btn">Se connecter</button>

        <?php
        if(!empty($_SESSION["error"]) && $_SESSION["error"] != ""){
            echo "<span class=' alert alert-danger mx-auto d-inline-block'>".$_SESSION["error"]."</span>";
        }
        ?>
    </form>
</section>