<?php



$categorie = $data["topics"][0]->getCategory()["name"];

?>

<h2 class="text-center">Liste des topics pour la catégorie <?=$categorie?></h2>

<?php

if(App\Session::getUser())
{
    
    echo '<a href="index.php?ctrl=forum&method=addTopicForm&id='.$data["topics"][0]->getCategory()["id_category"].'" class="btn btn-orange my-3">Créer un topic</a>';

}
else
{
    echo "<p class='font-weight-bold text-orange'>Vous n'êtes pas connecté! Connectez-vous afin de pouvoir créer un topic.</p>";
}
?>


<table class="table bg-light">
    <thead class="bg-orangered text-white">
        <tr>
            <th>Titre</th>
            <th>Status</th>
            <th>Dernier message par</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($data["topics"] as $topic)
    {
        $date = new DateTime($topic->getCreationDate());
        $topicDate = $date->format("d/m/Y, H\hi");
        $status = ($topic->getStatus() === 0) ? "Fermé" : "Ouvert";
        $lastMessageTime = 0; //On initialise cette variable qui servira a faire des comparaison pour récuperer le dernier message avec strtotime()
        $lastMessage; //On stockera le dernier message pour la catégorie avec toutes ses propriétés ici

        foreach($data["lastMessage"] as $topicTitle => $message) //$data["lastMessage"] est un tableau associatif ($key = titre du topic (string) et $value = message (array))
        {
            if($topicTitle === $topic->getTitle()) //On obtiendra que les messages appartenant à un topic qui lui-même appartient à la catégorie courante
            {
                $actualDate = strtotime($message["creationDate"]); /* On stocke la date du message en timestamp Unix, plus simple comme ça */
                if($actualDate > $lastMessageTime) //Si la date sur laquelle on boucle est plus grande que la dernière plus grande, alors on l'écrase et ainsi de suite...
                {
                    $lastMessageTime = $actualDate;
                    $lastMessage = $message;
                }
            }

        }

        $lastMessageDate = new DateTime($lastMessage["creationDate"]);
        $lastMessageDate = $lastMessageDate->format("d/m/Y, H\hi");

        echo "<tr>
        <td><a href='index.php?ctrl=forum&method=messageListById&id=".$topic->getId()."' class='h5'>".$topic->getTitle()."</a><br>Crée par <a href=''>".$topic->getUser()["username"]."</a> - ".$topicDate."</td>
        <td>".$status."</td>
        <td><a href=''>".$lastMessage["username"]."</a><br>".$lastMessageDate."  <a href=''><i class='fas fa-reply'></i></a></td>
        </tr>";
    }

    ?>
    </tbody>
</table>

