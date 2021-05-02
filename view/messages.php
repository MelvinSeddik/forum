<?php

$topic = $data["messages"][0]->getTopic()["title"];
$topicId = $data["messages"][0]->getTopic()["id_topic"];



?>



<h2 class="text-center">Liste des messages pour le topic <span class="text-orangered">"<?=$topic?>"</span></h2>

<?php

foreach($data["messages"] as $message){
    $registrationDate = new DateTime($message->getUser()["registrationDate"]);
    $registrationDate = $registrationDate->format("d/m/Y");
    $messageDate = new DateTime($message->getCreationDate());
    $messageDate = $messageDate->format("d/m/Y à H\hi");
?>
<div class="message-box row my-5">
    <aside class="d-flex flex-column col-3 bg-orangered text-white py-3">
        
        <figure class="figure overflow-hidden w-45 mx-auto">
            <figcaption class="text-center my-2"><?=$message->getUser()["username"]?></figcaption>
            <?php
            /* Si l'utilisateur possède un avatar */
            if($message->getUser()["avatar"] !== null || strlen($message->getUser()["avatar"]) >= 1)
            {
                echo '<img src="'.$message->getUser()["avatar"].'" alt="Image de profile" class="figure-img img-fluid rounded bg-dark">';
            }
            /* Sinon aucun avatar donc image par défaut */
            else
            {
                echo "<img src='".IMG_PATH."Default-Profile.png"."' alt='default' class='figure-img img-fluid rounded bg-dark'>";
            }
            ?>
            
        </figure>

        <q class="text-center mx-auto w-100"><?=$message->getUser()["description"]?></q>
        <p class="text-center">Inscrit depuis le <?=$registrationDate?></p>
    </aside>
    <div class="d-flex flex-column col-9 px-0">
        <div class="p-3 bg-dark text-white">Posté le <?=$messageDate?> 
            <div class="float-right text-white d-flex">
                <a><?=$message->getVoteUp()?> <i class="fas fa-thumbs-up"></i></a>
                <a class="mx-2 text-white"><?=$message->getVoteDown()?> <i class="fas fa-thumbs-down"></i></a>

                <?php

                echo 
                '<div class="dropdown">
                    <button class="bg-orange dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>'.'
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">';
                    echo '<a class="dropdown-item text-orange cite"><i class="fas fa-quote-right"></i> Citer le message</a>';

                        if(App\Session::getUser())
                        {
                            if(App\Session::isAdmin() || App\Session::getUser()->getId() === $message->getUser()["id_user"])
                            {
                                echo '<a href="index.php?ctrl=forum&method=editMessageForm&id=' . $message->getId() . '" class="dropdown-item text-info edit-msg"><i class="fas fa-edit"></i> Editer</a>
                                <a class="dropdown-item text-danger" href="index.php?ctrl=forum&method=deleteMessage&id='.$message->getId().'"><i class="fas fa-trash"></i> Supprimer</a>';
                            }
                        }
                    
                ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-9">
            <p class="my-4"><?=$message->getContent()?></p>
        </div>
    </div>



</div>
<?php
}

?>

<?php
    if(!empty($_SESSION["error"]) && $_SESSION["error"] != ""){
        echo "<span class='alert alert-danger mx-auto d-inline-block'>".$_SESSION["error"]."</span>";
    }
?>

<?php 

if(App\Session::getUser()){
    ?>
    <form action="index.php?ctrl=forum&method=addMessage&id=<?=$topicId?>" method="POST" class="w-75 mx-auto">

<h2 class="text-center">Ajouter un message</h2>

<textarea name="content" id="post" cols="30" rows="10" class="d-block w-100 mx-auto form-control"></textarea>

<button type="submit" class="btn login ml-auto d-block my-3">Envoyer</button>

</form>

<?php
}
else{
    echo "<p class='alert alert-info'>Vous devez être connecté pour pouvoir répondre</p>";
}

unset($_SESSION["error"]);
?>