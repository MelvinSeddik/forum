<?php

namespace Controller;

use Model\Manager\UserManager;

use App\Router;
use App\Session;

class SecurityController
{
    public function register()
    {

        if(!empty($_POST))
        {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $email = strtolower(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
            $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_STRING);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_STRING);

            if($username && $email && $password1 && $password2)
            {
                if($password1 == $password2)
                {
                    $model = new UserManager();

                    if(!$model->findOneByEmail($email))
                    {
                        $hash = password_hash($password1, PASSWORD_ARGON2I);

                        if($model->addUser($username, $email, $hash))
                        {
                            Router::redirectTo("home", "index");
                        }
                        else
                        {
                            $_SESSION["error"]->setError(4, "Echec de l'ajout");
                        }
                    }
                    else
                    {
                        $_SESSION["error"]->setError(3, "Email déjà existant");
                    }
                }
                else
                {
                    $_SESSION["error"]->setError(2, "Mots de passe différents");
                }
            }
            else
            {
                $_SESSION["error"]->setError(1, "Champs invalides manquants");
            }
        }
        else
        {
            $_SESSION["error"]->setError(8, "Champs manquants");
        }

        return 
        [
            "view"=> "security/register.php",
            "data"=> null
        ];
    }

    public function login()
    {
        if(!empty($_POST))
        {
            $email = strtolower(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);



            if($email && $password)
            {
                $userModel = new UserManager;

                if($user = $userModel->findOnebyEmail($email))
                {
                    if(password_verify($password, $user->getPassword()))
                    {
                        Session::setUser($user);
                        Router::redirectTo("home");
                    }
                    else
                    {
                        $_SESSION["error"]->setError(7, "Combinaison email et mot de passe eronné, veuillez réessayer");
                    }
                }
                else
                {
                    $_SESSION["error"]->setError(6, "Aucun utilisateur pour cet email");
                    
                }
            }
            else
            {
                $_SESSION["error"]->setError(9, "Champs invalides ou manquants");
            }
        }
        else
        {
            $_SESSION["error"]->setError(5, "Champs manquants");
        }
    }

    public function logout()
    {
        Session::removeUser();

        Router::redirectTo("home");
    }

}