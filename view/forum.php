<?php


?>

<h2 class="text-center">Liste des catégories</h2>

<table class="table table-responsive-md bg-light overflow-hidden">
    <thead class="bg-orangered text-white">
        <tr>
            <th>Catégorie</th>
            <th>Topic / Messages</th>
            <th>Dernier message</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
            <?php
            foreach($data["category"] as $category)
            {

                $topicCount = 0; //On initialise le compteur de topics pour la catégorie courante
                $msgCount = 0; //On initialise le compteur messages pour la catégorie courante
                $lastMessageTime = 0; //On initialise cette variable qui servira a faire des comparaison pour récuperer le dernier message avec strtotime()
                $lastMessage; //On stockera le dernier message pour la catégorie avec toutes ses propriétés ici

                
                $idCategory = $category->getId();
                foreach($data["topic"] as $topic) //On va regarder dans chaque topic
                {
                    if($topic->getCategory()["id_category"] === $idCategory) //On veut travailler uniquement avec les topics appartenant à la catégorie courante
                    {
                        $topicCount++; //Un passage dans la boucle = 1 topic de trouvé donc incrémentation
                        foreach($data["nbMessages"] as $topicTitle => $messages) //$data["nbMessages"] est un tableau associatif ($key = titre du topic (string) et $value = nombre de messages (int))
                        {
                            if($topic->getTitle() === $topicTitle) //Si le titre du topic correspond bien au topic de la boucle alors on incrémente le nombre de messages dans la catégorie actuelle
                            {
                                $msgCount += $messages;
                            }
                        }


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
                    }
                }
                $lastMessageDate = new DateTime($lastMessage["creationDate"]);
                $lastMessageDate = $lastMessageDate->format("d/m/Y, H\hi");

                $truncatedMsg = (strlen($lastMessage["content"]) > 60) ? substr($lastMessage["content"], 0, 60) . '...' : $lastMessage["content"];

                /* Une fois qu'on a fini de récupérer ce qui nous intéresse parmis les données, on affiche les valeurs */
                //Je me sert de substr afin de limiter la longueur du message a 50 caractères max
                echo "<tr>
                <td class='align-items-center'><a href='index.php?ctrl=forum&method=TopicListById&id=".$category->getId()."'>".$category->getName()."</a></td>
                <td>Topics : ".$topicCount."<br>Messages : $msgCount</td>
                <td>".$truncatedMsg."<br>Par <a href='#'>".$lastMessage["username"]."</a></td> 
                <td>".$lastMessageDate."</td>
                <td><a href='#'><i class='fas fa-reply'></i></a></td></tr>";
            }     
            ?>
        
        <?php
        if(!empty($_SESSION["error"]) && $_SESSION["error"] != ""){
            echo "<span class=' alert alert-danger mx-auto d-inline-block'>".$_SESSION["error"]."</span>";
        }
        ?>
    </tbody>
</table>


