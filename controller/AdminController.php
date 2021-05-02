<?php
namespace Controller;

/* On utilise la classe UserManager pour avoir accès à ses méthodes et propriétés */
use Model\Manager\UserManager;
use Model\Manager\CategoryManager;
use Model\Manager\TopicManager;
use Model\Manager\MessageManager;

class AdminController{
    /* Renvoie la page avec la liste de tous les utilisateurs */
    public function usersList()
    {
        $usermodel = new UserManager;
        $users = $usermodel->findAll();

        return 
        [
            "view"=> "adminUsersList.php",
            "data"=>
            [
                "users"=> $users
            ]
        ];
    }

    public function adminPanel(){
        $userModel = new UserManager;
        $users = $userModel->findAll();

        $categoryModel = new CategoryManager;
        $categories = $categoryModel->findAll();

        $topicModel = new TopicManager;
        $topics = $topicModel->findAll();

        $messageModel = new MessageManager;
        $messages = $messageModel->findAll();

        return 
        [
            "view"=> "adminPanel.php",
            "data"=>
            [
                "users"=> $users,
                "category"=> $categories,
                "topic"=> $topics,
                "message"=> $messages
            ]
        ];
    }

    public function categoriesList(){
        $categoryModel = new CategoryManager;
        $categories = $categoryModel->findAll();

        return
        [
            "view"=> "adminCategoryList.php",
            "data"=> 
            [
                "categories"=> $categories
            ]
            ];
    }

    public function topicsList(){
        $topicModel = new TopicManager;
        $topics = $topicModel->findAll();

        return 
        [
            "view"=> "adminTopicList.php",
            "data"=>
            [
                "topic"=> $topics
            ]
        ];
    }

    public function deleteOneById($id, $table)
    {
        switch($table){
            case "category" :
                $categoryModel = new CategoryManager;
                $categoryModel->deleteOneById($id);
                $method = "categoriesList";
            break;

            case "topic" :
                $topicModel = new TopicManager;
                $topicModel->deleteOneById($id);
                $method = "topicsList";
            break;

            case "users" :
                $userModel = new UserManager;
                $usersModel->deleteOneById($id);
                $method = "usersList";
            break;
        }

        return $this->$method();
    }

    public function updateCategoryForm($id)
    {
        $categoryModel = new CategoryManager;
        $category = $categoryModel->findOneById($id);


        return [
            "view"=> "updateCategoryForm.php",
            "data"=> 
            [
                "category"=> $category
            ]
        ];
    }

    public function updateCategory($id, $post)
    {
        $categoryModel = new CategoryManager;
        $categoryModel->updateById($id, $post);

        return $this->categoriesList();
    }

    public function updateTopicForm($id)
    {
        $topicModel = new TopicManager;
        $topic = $topicModel->findOneObjectById($id);

        $categoryModel = new CategoryManager;
        $categories = $categoryModel->findAll();

        $userModel = new UserManager;
        $users = $userModel->findAll();

        return [
            "view"=> "updateTopicForm.php",
            "data"=> 
            [
                "topic"=> $topic,
                "users"=> $users,
                "categories"=> $categories
            ]
        ];
    }

    public function updateTopic($id, $post)
    {
        $topicModel = new TopicManager;
        $topicModel->updateById($id, $post);

        return $this->topicsList();
    }

    public function addCategoryForm()
    {
        return [
            "view"=> "addCategoryForm.php",
            "data"=> null
        ];
    }

    public function addCategory($post)
    {
        if(!empty($post["name"]))
        {
            $categoryModel = new CategoryManager();


            if(!$categoryModel->findOneByName($post["name"]))
            {
                $categoryModel->addOne($post);
            }

    
            return $this->categoriesList();
        }

    }
}
