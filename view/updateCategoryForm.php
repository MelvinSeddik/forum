<form action="./index.php?ctrl=admin&method=updateCategory&id=<?=$data["category"]["id_category"]?>" method="POST" class="w-50 mx-auto">

        <label for="name">Nom de la catégorie</label>
        <input type="text" name="name" value="<?=$data["category"]["name"]?>" class="form-control">
        
        <input type="hidden" name="token" value="<?=$token?>">

        <button type="submit" name="submit" class="login my-4 p-2">Modifier</button>

</form>