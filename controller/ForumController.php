<?php

namespace Controller;

use Model\Manager\CategoryManager;
use Model\Manager\TopicManager;
use Model\Manager\MessageManager;
use Model\Manager\UserManager;
use App\Router;
use App\Session;
use App\Addflash;

class ForumController
{
    public function allLists()
    {
        $categoryModel = new CategoryManager;
        $categories = $categoryModel->findAll();

        $topicModel = new TopicManager;
        $topics = $topicModel->findAll();

        $messageModel = new MessageManager;
        $messages = $messageModel->findAll();

        /* Stocke le nombre de messages pour chaque topic en tableau associatif */
        $nbMessagesTopic = [];
        $lastMessage = [];
        foreach($categories as $category)
        {
            foreach($topics as $topic)
            {
                if($topic->getCategory()["id_category"] === $category->getId())
                {
                    $nbMessagesTopic[$topic->getTitle()] = sizeOf($topicModel->findMessagesByTopic($topic->getId()));
                    $lastMessage[$topic->getTitle()] = $topicModel->getLastMessageByTopic($topic->getId());
                }
            }
        }

        /* Récupère le dernier message pour chaque topic */
        

        return 
        [
            "view"=> "forum.php",
            "data"=> 
            [
                "category"=> $categories,
                "topic"=> $topics,
                "message"=> $messages,
                "nbMessages"=> $nbMessagesTopic,
                "lastMessage"=> $lastMessage
            ]
        ];
    }

    
    public function topicListById($id)
    {
        $topicModel = new TopicManager;
        $topics = $topicModel->findAllByCat($id);

        $messageModel = new MessageManager;
        $messages = $messageModel->findAll();

        /* Stocke le nombre de messages pour chaque topic en tableau associatif */
        $nbMessagesTopic = [];
        $lastMessage = [];

        foreach($topics as $topic)
        {
                $nbMessagesTopic[$topic->getTitle()] = sizeOf($topicModel->findMessagesByTopic($topic->getId()));
                $lastMessage[$topic->getTitle()] = $topicModel->getLastMessageByTopic($topic->getId());
        }
        
        return
        [
            "view"=> "topics.php",
            "data"=>
            [
                "topics"=> $topics,
                "nbMessages"=> $nbMessagesTopic,
                "lastMessage"=> $lastMessage
            ]
        ];
    }

    public function messageListById($id)
    {
        $messageModel = new MessageManager;
        $messages = $messageModel->findAllByTopic($id);

        return
        [
            "view"=> "messages.php",
            "data"=>
            [
                "messages"=> $messages
            ]
        ];
    }

    /*  */

    public function addTopicForm($id)
    {
        $categoryModel = new CategoryManager;
        $category = $categoryModel->findOneById($id);

        return
        [
            "view"=> "addTopicForm.php",
            "data"=> 
            [
                "category"=> $category
            ]
        ];
    }

    public function addTopic($id, $post)
    {
        $topicModel = new TopicManager;
        $topicModel->addOne($id, $post);

        return Router::redirectTo("forum", "allLists");
    }

    public function addMessage($id, $post)
    {

        if(isset($post["content"]) && !empty($post["content"] && $post["content"] != ""))
        {
            $messageModel = new MessageManager;
            $message = $messageModel->getOneById($id);

            $messageModel->addOne($id, $post);
    
            $url = "index.php?ctrl=forum&method=messageListById&id=".$message[0]->getTopic()["id_topic"];

            return header("Location: $url");
        }
        else
        {
            $_SESSION["error"] = new addFlash();
            $_SESSION["error"]->setError(10, "Veuillez saisir un message");
            return Router::redirectTo("forum", "allLists");

        }

    }
    
    public function editMessageForm($id)
    {
        $messageModel = new MessageManager;
        $message = $messageModel->getOneById($id);

        if($message[0]->getUser()["id_user"] === Session::getUser()->getId())
        {
            return
            [
                "view"=> "editMessageForm.php",
                "data"=> 
                [
                    "message"=> $message
                ]
            ];
        }
        else
        {
            $_SESSION["error"] = new addFlash();
            $_SESSION["error"]->setError(11, "Vous ne pouvez pas faire cette action");

            $url = "index.php?ctrl=forum&method=messageListById&id=".$message[0]->getTopic()["id_topic"];

            return header("Location: $url");
        }


    }

    public function editMessage($id, $post)
    {
        $messageModel = new MessageManager;
        $message = $messageModel->getOneById($id);

        if($message[0]->getUser()["id_user"] === Session::getUser()->getId())
        {
            $messageModel->editOneById($id, $post);

            $url = "index.php?ctrl=forum&method=messageListById&id=".$message[0]->getTopic()["id_topic"];
    
            return header("Location: $url");
        }
        else
        {
            $_SESSION["error"] = new addFlash();
            $_SESSION["error"]->setError(12, "Vous ne pouvez pas faire cette action");

            $url = "index.php?ctrl=forum&method=messageListById&id=".$message[0]->getTopic()["id_topic"];

            return header("Location: $url");
        }

    }

    public function deleteMessage($id)
    {
        $messageModel = new MessageManager;
        $message = $messageModel->getOneById($id);

        if($message[0]->getUser()["id_user"] === App\Session::getUser()->getId())
        {
            $messageModel->deleteOneById($id);

            $url = "index.php?ctrl=forum&method=messageListById&id=".$message[0]->getTopic()["id_topic"];
    
            return header("Location: $url");
        }
        else
        {
            $_SESSION["error"] = new addFlash();
            $_SESSION["error"]->setError(13, "Vous ne pouvez pas faire cette action");

            $url = "index.php?ctrl=forum&method=messageListById&id=".$message[0]->getTopic()["id_topic"];

            return header("Location: $url");
        }


    }


}

?>