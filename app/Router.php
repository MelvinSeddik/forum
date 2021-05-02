<?php
    namespace App;

    abstract class Router
    {
        /* public -> on peux y acceder partout dans notre application */
        public static function handleRequest($get){
            $ctrlname = "Controller\HomeController";
            $method = "index";
            
            // S'il y'a un controller dans l'URL 
            if(isset($get['ctrl'])){
                $ctrlname = "Controller\\".ucfirst($get['ctrl'])."Controller"; // Double antislash -> On échappe le caractère d'échappement sinon ça échappe la double quote...
            }
            
            //On crée une nouvelle instance du controller
            $ctrl = new $ctrlname();
            

            /* Stockage addflash */
            if(!isset($_SESSION["error"])){
                $_SESSION["error"] = new Addflash();
            }

            if(!isset($_SESSION["success"])){
                $_SESSION["success"] = new Addflash();
}
            // Si la méthode est définie dans l'url et si elle existe 
            if(isset($get['method']) && method_exists($ctrl, $get['method'])){
                $method = $get['method'];
            }

            if(isset($get['id'])){
                $id = filter_var($get["id"], FILTER_SANITIZE_NUMBER_INT);
            }

            if(isset($get['table'])){
                $table = filter_var($get["table"], FILTER_SANITIZE_STRING);
            }

            /* On filtre les données récupérées avant de les envoyer */
            if(isset($_POST) && !empty($_POST)){
                $post = filter_var_array($_POST);
            }

            if(isset($get["search"])){
                $ctrlname = "Controller\SearchController";
                $ctrl = new $ctrlname;
                return $ctrl->getSearchResults($get["search"]);            }
            
            /* Retourne l'execution de la méthode du controller (Ce qui nous redirige donc vers une vue avec des données à afficher) */
            if(isset($post) && isset($id) && !isset($table)){
                return $ctrl->$method($id, $post);
            }

            elseif(isset($post) && !isset($id) && !isset($table)){
                return $ctrl->$method($post);
            }

            elseif(isset($id) && isset($table)){
                return $ctrl->$method($id, $table);  
            }

            elseif(isset($id) && !isset($table)){
                return $ctrl->$method($id);  
            }

            else{
                return $ctrl->$method();
            }

        }

        public static function redirectTo($ctrl = null, $method = null){

            header("Location:?ctrl=".$ctrl."&method=".$method);
            die();
           
        }

        public static function CSRFProtection($token)
        {
            if(!empty($_POST))
            {
                if(isset($_POST["token"]))
                {
                    $form_csrf = $_POST["token"];
                    if(hash_equals($form_csrf, $token))
                    {
                        return true;
                    }
                }
                return false;

            }
            return true;
        }

    }

    