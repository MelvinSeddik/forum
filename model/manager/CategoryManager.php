<?php

namespace Model\Manager;

use App\AbstractManager;

class CategoryManager extends AbstractManager
{
    private static $classname = "Model\Entity\Category";

    public function __construct()
    {
        self::connect(self::$classname);
    }

    public function findOneById($id)
    {
        $sql = "SELECT * FROM Category WHERE id_category = :id";
        
        return self::select($sql, [":id"=>$id], false);
        
    }

    public function findAll()
    {
        $sql = "SELECT * FROM Category ORDER BY id_category ASC";

        return self::getResults(
            self::select($sql, null, true),
            self::$classname
        );
    }

    public function deleteOneById($idCat)
    {
        $sql = "DELETE FROM Category
        WHERE id_category = :id";
        
        return self::delete($sql, [":id"=> $idCat]);
    }

    public function updateById($id, $post)
    {
        $sql = "UPDATE Category
        SET name = :name
        WHERE id_category = :id";

        $name = $post["name"];

        return self::update($sql, [":id"=> $id, ":name"=> $name]);
    }

    public function addOne($post)
    {
        $sql = "INSERT INTO Category (name)
        VALUES(:name)";

        $name = $post["name"];

        return self::create($sql, [":name"=> $name]);
    }

    public function findOneByName($name)
    {
        $sql = "SELECT * FROM Category WHERE name = :name";

        return self::select($sql, [":name"=> $name], false);
    }

    public function mostTopics()
    {
        $sql = "SELECT COUNT(topic_id) AS nbTopic, name FROM Topic t
        INNER JOIN Message m ON m.topic_id = t.id_topic
        INNER JOIN Category c ON c.id_category = t.category_id
        GROUP BY topic_id
        ORDER BY nbTopic DESC
        LIMIT 5
        ";

        return self::select($sql, null, true);
    }
}

?>