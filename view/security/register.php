<section class="form-container">
    <form action="./index.php?ctrl=security&method=register" method="POST">
        <h2 class="text-center text-white my-3">Inscrivez-vous!</h2>

        <div class="input-group">
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username" placeholder="Entrez votre pseudo" disabled required>
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Entrez votre email" disabled required>
        </div>

        <div class="input-group">
            <label for="password1">Mot de passe</label>
            <input type="password" name="password1" id="password1" placeholder="Entrez votre mot de passe" disabled required>
        </div>

        <div class="input-group">
            <label for="password2">Confirmez votre mot de passe</label>
            <input type="password" name="password2" id="password2" placeholder="Confirmez votre mot de passe" disabled required>
        </div>

        <input type="hidden" name="token" value="<?=$token?>">

        <button type="submit" class="btn">S'inscrire</button>


    </form>

    <?php
        if(!empty($_SESSION["error"]) && $_SESSION["error"] != ""){
            echo "<span class=' alert alert-danger mx-auto d-inline-block'>".$_SESSION["error"]."</span>";
        }
        ?>
</section>