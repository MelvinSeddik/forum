<?php
    $status = ($data["topic"][0]->getStatus() === 0) ? "Fermé" : "Ouvert";

    $creationDate = new DateTime($data["topic"][0]->getCreationDate());
    $creationDate = $creationDate->format("Y-m-d\TH:i:s"); //On stocke la date dans ce format pour la mettre dans un input[type="datetime-local"] en tant que value
?>

<form action="./index.php?ctrl=admin&method=updateTopic&id=<?=$data["topic"][0]->getId()?>" method="POST" class="w-50 mx-auto">

<label for="title">Titre du topic</label>
<input type="text" name="title" value="<?=$data["topic"][0]->getTitle()?>" class="form-control" required>

<label for="creationDate">Date de création</label>
<input type="datetime-local" step="1" name="creationDate" value="<?=$creationDate?>" class="form-control" required>

<label for="status">Status</label>
<select name="status" id="status" class="form-control">
    <?php


    if($data["topic"][0]->getStatus() == 1)
    {
        echo "<option value='0'>Fermé</option>";
        echo "<option value='1' selected>".$status."</option>";
    }
    else
    {
        echo "<option value='0' selected>Fermé</option>";
        echo "<option value='1'>".$status."</option>";
    }
    ?>

</select>

<label for="name">Catégorie</label>
<select name="category" id="category" class="form-control">
    <?php
    foreach($data["categories"] as $category)
    {
        if($category->getId() === $data["topic"][0]->getCategory()["id_category"])
        {
            echo "<option value='".$category->getId()."' selected>".$category->getName()."</option>";
        }
        else
        {
            echo "<option value='".$category->getId()."'>".$category->getName()."</option>";
        }

    }
    ?>
</select>

<label for="user">Auteur</label>
<select name="user" id="user" class="form-control">
    <?php
    foreach($data["users"] as $user)
    {
        if($user->getId() === $data["topic"][0]->getUser()["id_user"])
        {
            echo "<option value='".$user->getId()."' selected>".$user->getUsername()."</option>";
        }
        else
        {
            echo "<option value='".$user->getId()."'>".$user->getUsername()."</option>";
        }

    }
    ?>
</select>

<input type="hidden" name="token" value="<?=$token?>">

<button type="submit" name="submit" class="login my-4 p-2">Modifier</button>

</form>