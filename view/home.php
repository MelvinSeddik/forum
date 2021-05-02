<?php


    if(App\Session::getUser())
    {
        if(App\Session::isAdmin())
        {
            
        }
    }
    echo '<a href="?ctrl=admin&method=adminPanel" class="btn btn-orange text-white">Admin Panel</a>'; // affichage du bouton pour acceder au panneau administrateur
  
?>


<h1 class="text-center">Page d'accueil</h1>

<h1 class="text-center">Bienvenue sur le forum 😊!</h1>

<h2>Les 5 catégories avec le plus de topics : </h2>

<ul>
    <?php
    foreach($data["categories"] as $category)
    {
        echo "<li>".$category["name"]."</li>";
    }
    ?>
</ul>