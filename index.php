<?php

namespace App;

require_once "app/Autoloader.php";
Autoloader::register();

use App\Router;


/* On définit les chemins d'accès à nos ressources */
define("DS", DIRECTORY_SEPARATOR); //DS -> /
define("ROOT_DIR", ".".DS); //ROOT_DIR -> ./
define("PUBLIC_PATH", ROOT_DIR."public".DS); //PUBLIC_PATH -> ./public/
define("CSS_PATH", PUBLIC_PATH."css".DS); // CSS_PATH -> ./public/css/
define("IMG_PATH", PUBLIC_PATH."img".DS); //IMG_PATH -> ./public/img/
define("JS_PATH", PUBLIC_PATH."js".DS); //JS_PATH -> ./public/js/
define("VIEW_PATH", ROOT_DIR."view".DS); //VIEW_PATH -> ./view/
define("CTRL_PATH", ROOT_DIR."controller".DS); //CTRL_PATH -> ./controller/
define("SERVICE_PATH", ROOT_DIR."app".DS); //SERVICE_PATH -> ./app/

/* On genere une clé */
Session::generateKey();
/* On genere le token */
$token = hash_hmac("sha256", "devineca", Session::getKey());



if(Router::CSRFProtection($token))
{
    $result = Router::handleRequest($_GET);
} else Router::redirectTo("security", "logout");


/* Si la vérification est bonne on autorise la suite */

/* On appelle la méthode statique du router en lui passant la valeur de l'url et on stocke le resultat dans une variable */
/* La variable result contient le resultat de la méthode du controller qui a été solicité */


/* Démarage de la mémoire tampon */
ob_start();

/* Si le resultat est un tableau et que la clé view existe */
if(is_array($result) && array_key_exists("view", $result))
{
    $data = isset($result["data"]) ? $result["data"] : null; //S'il y'a des données on les stockes dans une variable pour que la vue puisse s'en servir
    include VIEW_PATH.$result["view"]; //On redirige vers la vue qui a été demandé lors de la requête

}
else
    include VIEW_PATH."404.html"; // revient à faire -> include "./view/404.html"
    $page = ob_get_contents(); //ob_get_contents() -> Retourne le contenu du tampon
    ob_end_clean(); // ob_end_clean() -> Détruit le tampon
    include VIEW_PATH."layout.php"; // revient à faire -> include "./view/layout.php"





