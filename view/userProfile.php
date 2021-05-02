<?php

$user = App\Session::getUser();

$date = new DateTime($user->getRegistrationDate());

?>

<div class="d-flex flex-column align-items-center">

    <h1>Votre profil</h1>

    <h2>Informations du compte</h2>

    <div class="d-flex">

        <figure class="profileImg"><img src="<?=$user->getAvatar()?>" alt=""></figure>

        <ul>
            <li>Pseudo : <?=$user->getUsername()?></li>
            <li>E-mail : <?=$user->getEmail()?></li>
            <li>Mot de passe : *********</li>
            <li>Description : <?=($user->getDescription() === null) ? "Vous n'avez pas encore de description": $user->getDescription()?></li>
            <li>Inscrit le : <?=$date->format("d/m/Y")?></li>

        </lu>

    </div>

</div>
