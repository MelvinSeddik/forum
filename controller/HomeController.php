<?php

namespace Controller;

use Model\Manager\CategoryManager;
use Model\Manager\TopicManager;
use Model\Manager\MessageManager;

class HomeController
{
    //Affiche la page d'accueil
    public function index()
    {

        $categoryModel = new CategoryManager;
        $categories = $categoryModel->mostTopics();

        $topicModel = new TopicManager;
        $topics = $topicModel->findAll();

        $messageModel = new MessageManager;
        $messages = $messageModel->findAll();

        return [
            "view" => "home.php",
            "data" => 
            [
                "categories"=> $categories
            ],
            "titrePage" => "FORUM | ACCUEIL"
        ];
    }

}


?>