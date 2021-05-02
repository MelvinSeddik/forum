<?php



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--JQUERY-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <!--FONT AWESOME 5-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300&display=swap" rel="stylesheet">
    <!-- PERSONAL STYLESHEETS -->
    <link rel="stylesheet" href="<?= CSS_PATH?>style.css">
    <title>Forum</title>
</head>

<body>
    <!-- NAV -->
    <nav class="d-flex  align-items-center">
        <figure class="logo">
            <a href="index.php"><img src="<?=IMG_PATH.DS?>logo.png" alt=""></a>
        </figure>



        <ul class="float-right">
          <li><a href="index.php" class="home"><i class="fas fa-home"></i> Home</a></li>
          <li><a href="index.php?ctrl=forum&method=allLists" class="navitem"><i class="fas fa-comments"></i> Forum</a></li>
        </ul>
        
        <div class="d-flex align-items-center float-right ml-auto account">
        <?php

        if(App\Session::getUser())
        {
            echo 
            '<div class="dropdown">
            <button class="btn btn-primary bg-orange dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>'.$_SESSION["user"]->getUsername().'
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="index.php?ctrl=user&method=profile"><i class="fas fa-id-card text-orange"></i> Mon profil</a>
              <a class="dropdown-item" href="index.php?ctrl=security&method=logout"><i class="fas fa-power-off text-orange"></i> Déconnexion</a>
            </div>
            </div>';
            
        }
        else
        {
            echo '<a href="index.php?ctrl=user&method=signUpForm" class="btn sign-up">Inscription</a>';
            echo '<a href="index.php?ctrl=user&method=loginForm" class="btn login">Connexion</a>';
        }
        ?>
        </div>
    </nav>

    <!-- BANNER -->
    <section class="banner">
        <div class="banner-container">
            <h1><span class="noselect">THE FORUM</span><br></h1>
        </div>
    </section>

    <!-- MAIN -->
    <main>

    <div class="d-flex justify-content-space-between mb-5">
        <form action="./index.php?ctrl=search&method=getSearchResults" method="POST" class="d-flex align-items-center ml-auto">
          <input type="search" name="search" id="searchBar" class="form-control" placeholder="Chercher dans les topics...">
          <button type="submit" name="submit" id="submitSearch" class="btn btn-red"><i class="fas fa-search"></i></button>
    </form>

    </div>

        <?= $page ?>

    </main>


    <!-- FOOTER -->
    <footer class="py-4 flex-shrink-0 mt-auto">
        <div class="container text-center">
            <small>Copyright © 2021 - Melvin SEDDIK, All Rights Reserved</small>
        </div>
    </footer>



    <script src="<?=JS_PATH?>navbar.js"></script>
    <script src="<?=JS_PATH?>mainResize.js"></script>
    <script src="<?=JS_PATH?>formEffects.js"></script>
</body>
</html>