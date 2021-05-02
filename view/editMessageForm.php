<form action="./index.php?ctrl=forum&method=editMessage&id=<?=$data["message"][0]->getId()?>" method="POST">
    <textarea id="" cols="30" rows="10" name="content" class="form-control"><?=$data["message"][0]->getContent()?></textarea>

    <input type="hidden" name="token" value="<?=$token?>">
    
    <button type="submit" class="btn login">Modifier</button>
</form>