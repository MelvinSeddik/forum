<?php

namespace Model\Manager;

use App\AbstractManager;
use App\Session;

class MessageManager extends AbstractManager
{
    private static $classname = "Model\Entity\Message";

    public function __construct()
    {
        self::connect(self::$classname);
    }

    public function findOneById($id)
    {
        $sql = "SELECT * FROM Message WHERE id_message = :id";

        return self::select($sql, [":id"=>$id], false);
    }

    public function getOneById($id)
    {
        $sql = "SELECT * FROM Message WHERE id_message = :id";

        return self::getResults(
            self::select($sql, [":id"=> $id], true),
            self::$classname
        );
    }

    public function findAll()
    {
        $sql = "SELECT * FROM Message";

        return self::getResults(
            self::select($sql, null, true),
            self::$classname
        );
    }

    public function findAllByTopic($idTopic)
    {
        $sql = "SELECT * FROM Message WHERE topic_id = :id";

        return self::getResults(
            self::select($sql, ["id"=> $idTopic], true),
            self::$classname
        );
    }

    public function deleteOneById($id)
    {
        $sql = "DELETE FROM Message
        WHERE id_message = :id";
        
        return self::delete($sql, [":id"=> $id]);
    }

    public function addOne($id, $post)
    {
        $sql = "INSERT INTO Message (content, topic_id, user_id)
        VALUES (:content, :topic_id, :user_id)";

        return self::create($sql, [":content"=> $post["content"], ":topic_id"=> $id, ":user_id"=> Session::getUser()->getId()]);


    }

    public function editOneById($id, $post)
    {   
        $sql = "UPDATE Message
        SET content = :content
        WHERE id_message = :id";

        return self::update($sql, [":content"=> $post["content"], ":id"=> $id]);
    }

}

?>