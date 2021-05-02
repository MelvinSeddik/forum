<!-- TOPICS -->

<h1 class="text-center">Liste des topics</h1>

<a href="" class="btn btn-orange my-4">Ajouter un topic</a>

<table class="table bg-light">
    <thead class="bg-orange text-white">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date de création</th>
            <th>Status</th>
            <th>Categorie</th>
            <th>Crée par</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($data["topic"] as $topic)
    {
        $date = new DateTime($topic->getCreationDate());
        $creationDate = $date->format("d/m/Y à H\hi");
        echo "<tr>
        <td>".$topic->getId()."</td>
        <td><a href='index.php?ctrl=forum&method=messageListById&id=".$topic->getId()."'>".$topic->getTitle()."</a></td>
        <td>".$creationDate."</td>
        <td>".$topic->getStatus()."</td>
        <td>".$topic->getCategory()["name"]."</td>
        <td><a href=''>".$topic->getUser()["username"]."</a></td>
        <td><a href='index.php?ctrl=admin&method=updateTopicForm&id=".$topic->getId()."' class='text-orange'><i class='fas fa-edit'></i></a></td>
        <td><a href='index.php?ctrl=admin&method=deleteOneById&id=".$topic->getId()."&table=topic' class='text-danger'><i class='fas fa-trash'></i></a></td>
        </tr>";
    }
    
    
    ?>
    </tbody>
</table>