<?php


namespace Controller;

/* On utilise la classe UserManager pour avoir accès à ses méthodes et propriétés */
use Model\Manager\UserManager;
use Model\Manager\CategoryManager;
use Model\Manager\TopicManager;
use Model\Manager\MessageManager;

class UserController
{
    /* Enregistre un utilisateur dans la bdd */
    public function signUpForm()
    {
        return [
            "view"=> "security/register.php",
            "data"=> null
        ];
    }

    /* Connecte un utilisateur */
    public function loginForm()
    {
        return 
        [
            "view"=> "security/login.php",
            "data"=> null
        ];
    }


    public function logout()
    {
        unset($_SESSION["user"]);

    }

    public function profile()
    {
        return
        [
            "view"=> "userProfile.php",
            "data"=> null
        ];
    }
}

?>