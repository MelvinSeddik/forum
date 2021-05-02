<?php
    namespace App;

    /* Classe qui va être sollicitée par les Manager dans la couche model */
    //Contient des fonctions permettant de communiquer avec la base de données
    abstract class AbstractManager
    {
        private static $connection;

        //Les méthodes et variables statiques sont accessibles sans avoir besoin d'instancier la classe.
        //Elles ne sont donc PAS associés à un objet, mais plutôt à la CLASSE elle-même.
        //Puisque $this se réfère à l'objet actuel nous ne l'utiliserons pas.
        //Nous utiliserons plutôt self, qui se réfère à la classe actuelle.
        //Les méthodes statiques ont uniquement accès à des variables étant, elles aussi, définies comme statique.

        
        protected static function connect(){
            self::$connection = DAO::getConnection();
        }

        protected static function getOneOrNullResult($row, $class){
            
            if($row != null){
                return new $class($row);
            }
            return null;
        }
        protected static function getOneOrNullResultInt($row){
            
            if($row != null){
                return $row;
            }
            return null;
        }

        /* A besoin des lignes de résultats d'une requête SQL ainsi que du nom d'une classe */
        protected static function getResults($rows, $class){
            
            $results = [];
            
            if($rows != null){
                foreach($rows as $row){
                    $results[] = new $class($row); //C'est ici que la classe d'une entité est instanciée et hydratée
                }
            }
            return $results;
        }

        /* Récupère uniquemenet les résultat d'une requête */
        protected static function select($sql, $params = null, $multiple = true){
            $stmt = self::$connection->prepare($sql);
            $stmt->execute($params);

            if($multiple){
                return $stmt->fetchAll();
            }
            return $stmt->fetch();

        }

        protected static function create($sql, $params){
            $stmt = self::$connection->prepare($sql);
            
            return $stmt->execute($params);
        }

        protected static function update($sql, $params){
            $stmt = self::$connection->prepare($sql);

            return $stmt->execute($params);
        }

        protected static function delete($sql, $params){
            $stmt = self::$connection->prepare($sql);
            
            return $stmt->execute($params);
        }

        protected static function getLastId(){
            
            return self::$connection->lastInsertId();
        }

        
    }