<!-- CATEGORIES -->

<h1 class="text-center">Liste des catégories</h1>

<a href="index.php?ctrl=admin&method=addCategoryForm" class="btn btn-orange my-4">Ajouter une catégorie</a>

<table class="table bg-light">
    <thead class="bg-orange text-white">
        <tr>
            <th>ID</th>
            <th>Catégorie</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($data["categories"] as $category)
    {
        echo "<tr>
        <td>".$category->getId()."</td>
        <td><a href='index.php?ctrl=forum&method=topicListById&id=".$category->getId()."'>".$category->getName()."</a></td>
        <td><a href='index.php?ctrl=admin&method=updateCategoryForm&id=".$category->getId()."' class='text-orange'><i class='fas fa-edit'></i></a></td>
        <td><a href='index.php?ctrl=admin&method=deleteOneById&id=".$category->getId()."&table=category' class='text-danger'><i class='fas fa-trash'></i></a></td>
        </tr>";
    }
    
    ?>
    </tbody>
</table>

