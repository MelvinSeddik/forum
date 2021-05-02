<!-- UTILISATEURSS -->

<h1 class="text-center">Liste des utilisateurs</h1>

<a href="" class="btn btn-orange my-4">Ajouter un utilisateur</a>

<table class="table bg-light">
    <thead class="bg-orange text-white">
        <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Mot de passe</th>
            <th>Avatar</th>
            <th>Description</th>
            <th>Role</th>
            <th>Date d'inscription</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($data["users"] as $user)
    {
        $date = new DateTime($user->getRegistrationDate());
        $registrationDate = $date->format("d/m/Y à H:i");
        echo "<tr>
        <td>".$user->getId()."</td>
        <td><a href=''>".$user->getUsername()."</a></td>
        <td>".$user->getEmail()."</td>
        <td>".$user->getPassword()."</td>
        <td>".$user->getAvatar()."</td>
        <td>".$user->getDescription()."</td>
        <td>".$user->getRole()."</td>
        <td>".$registrationDate."</td>
        <td><a href='' class='text-orange'><i class='fas fa-edit'></i></a></td>
        <td><a href='index.php?ctrl=admin&method=deleteOneById&id=".$user->getId()."&table=users' class='text-danger'><i class='fas fa-trash'></i></a></td>
        </tr>";
    }
    
    
    ?>
    </tbody>
</table>

