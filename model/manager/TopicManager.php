<?php

namespace Model\Manager;

use App\AbstractManager;
use App\Session;

class TopicManager extends AbstractManager
{
    private static $classname = "Model\Entity\Topic";

    public function __construct()
    {
        self::connect(self::$classname);
    }

    public function findOneById($id)
    {
        $sql = "SELECT * FROM Topic WHERE id_topic = :id";
        
        return self::select($sql, [":id"=>$id], false);
    }

    public function findOneObjectById($id) //Récupère également toutes les informations des clés étrangères
    {
        $sql = "SELECT * FROM Topic WHERE id_topic = :id";
        
        return self::getResults(
            self::select($sql, [":id"=> $id], true),
            self::$classname
        );
    }

    public function findAll()
    {
        $sql = "SELECT * FROM Topic";

        return self::getResults(
            self::select($sql, null, true),
            self::$classname
        );
    }

    /* Trouve tous les topics appartenant a une catégorie */
    public function findAllByCat($idCat)
    {
        $sql = "SELECT * FROM Topic WHERE category_id = :id";

        return self::getResults(
            self::select($sql, [":id"=> $idCat], true),
            self::$classname
        );
    }

    public function findMessagesByTopic($idTopic)
    {
        $sql = "SELECT id_message AS nb_messages
        FROM Message m
        INNER JOIN Topic t ON t.id_topic = m.topic_id
        WHERE topic_id = :id";

        return self::select($sql, [":id"=>$idTopic], true);

    }

    public function getLastMessageByTopic($idTopic)
    {
        $sql = "SELECT * FROM message m
        INNER JOIN Users u ON u.id_user = m.user_id
        WHERE m.creationDate = 
            (SELECT MAX(m.creationDate)
            FROM message m
            INNER JOIN Topic t ON t.id_topic = m.topic_id
            INNER JOIN category c ON c.id_category = t.category_id
            WHERE id_topic = :id)";

        return self::select($sql, [":id"=>$idTopic], false);

    }

    public function deleteOneById($id)
    {
        $sql = "DELETE FROM Topic
        WHERE id_topic = :id";
        
        return self::delete($sql, [":id"=> $id]);
    }

    public function updateById($id, $post)
    {
        $sql = "UPDATE Topic
        SET title = :title, creationDate = :date, status = :status, category_id = :category, user_id = :user
        WHERE id_topic = :id";

        $post = filter_var_array($post);

        $title = $post["title"];
        $creationDate = $post["creationDate"];
        $status = $post["status"];
        $category = $post["category"];
        $user = $post["user"];

        return self::update($sql, [":id"=> $id, ":title"=> $title, ":date"=> $creationDate, ":status"=> $status, ":category"=> $category, ":user"=> $user]);
    }

    public function addOne($id, $post)
    {

        $sql = "INSERT INTO Topic (title, category_id, user_id)
        VALUES (:title, :category, :user)";

        self::create($sql, [":title"=> $post["title"], ":category"=> $id, ":user"=> Session::getUser()->getId()]);

        $lastId = self::getLastId();
        
        $sql = "INSERT INTO Message (content, topic_id, user_id)
        VALUES (:content, :topic, :user)";

        self::create($sql, [":content"=> $post["message"], ":topic"=> $lastId, ":user"=> Session::getUser()->getId()]);

    }
}

?>