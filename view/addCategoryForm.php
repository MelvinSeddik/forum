<form action="./index.php?ctrl=admin&method=addCategory" method="POST" class="w-50 mx-auto">

    <label for="name">Nom de la catégorie</label>
    <input type="text" name="name" class="form-control" placeholder="">

    <input type="hidden" name="token" value="<?=$token?>">
    
    <button type="submit" name="submit" class="btn login my-4">Ajouter</button>

</form>