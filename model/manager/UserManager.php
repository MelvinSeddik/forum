<?php

namespace Model\Manager;

use App\AbstractManager;

class UserManager extends AbstractManager
{
    private static $classname = "Model\Entity\User"; // Fully qualified classname

    public function __construct()
    {
        self::connect(self::$classname);
    }

    public function findOneById($id)
    {
        $sql = "SELECT * FROM Users WHERE id_user = :id";

        return self::select($sql, [":id"=>$id], false);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM Users";

        return self::getResults(
            self::select($sql, null, true),
            self::$classname
        );
    }

    public function deleteOneById($id)
    {
        $sql = "DELETE FROM Users
        WHERE id_users = :id";
        
        return self::delete($sql, [":id"=> $id]);
    }

    public function findOneByEmail($email)
    {
        $sql = "SELECT * FROM Users WHERE email = :email";

        return self::getOneOrNullResult(
            self::select($sql, [":email"=> $email], false),
            self::$classname
        );
    }


    public function addUser($username, $email, $hash)
    {
        $sql = "INSERT INTO users(username, email, password) VALUES (:username, :email, :password)";

        return self::create($sql, [":username"=> $username, ":email"=> $email, ":password"=> $hash]);
        
    }
}

?>