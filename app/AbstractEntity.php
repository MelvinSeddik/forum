<?php
    namespace App;

    //Une classe abstraite NE PEUT PAS être instanciée et PEUT contenir des méthodes abstraites
    // Seulement les enfants héritant de cette classe auront accès à ses méthodes et propriétés protected
    // Les méthodes définies comme abstraites devront obligatoirement être définies dans la classe enfant
    
    abstract class AbstractEntity
    {
        /* Hydradateur récursif : faire comprendre que la clé étrangère récupère un objet */
        /* On accède à ses données avec son entité */

        /* On récupère les données d'une entité ainsi que l'objet correspondant */
        protected static function hydrate($data, $object){
            
            foreach($data as $field => $value){
                $fieldArray = explode("_", $field); // id_user => ["id", "user"] | user_id => ["user", "id"] (fonction explode)

                /* En cas de clé étrangère ==> dans $fieldArray[],  le nom du manager sera à l'index 0 et l'id a l'index 1 */
                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                    $className = ucfirst($fieldArray[0])."Manager"; //Nom du manager
                    $FQCName = "Model\Manager".DS.$className; // Fully qualified class name
                    $man = new $FQCName(); // On instancie le Manager sollicité
                    $value = $man->findOneById($value); // $value est dans ce cas égal à la valeur de l'id de la clé étrangère (ex: '4') avant d'être écrasée par le résultat de findOneById($value) du Manager
                }
                
                $method = "set".ucfirst($fieldArray[0]);
                if(method_exists($object, $method)){
                    $object->$method($value);
                }
            }
        }
    }