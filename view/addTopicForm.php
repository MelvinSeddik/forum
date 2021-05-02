
<h2 class="text-center">Ajout d'un topic dans la catégorie "<?=$data["category"]["name"]?>"</h2>

<form action="./index.php?ctrl=forum&method=addTopic&id=<?=$data["category"]["id_category"]?>" method="POST" class="w-50 mx-auto">

    <div class="form-group">
        <label for="title">Titre du topic</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="message">Votre message</label>
        <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <input type="hidden" name="token" value="<?=$token?>">

    <button type="submit" name="submit" class="btn login my-3">Valider</button>

</form>