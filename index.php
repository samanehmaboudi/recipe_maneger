<?php
require_once 'classes/CRUD.php';

$crud = new CRUD();


$users = $crud->select('users');


$categories = $crud->select('categories');


$recipes = $crud->select('recipes');


$comments = $crud->select('comments');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Recettes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Gestion des Recettes</h1>

    <h2><a href="create_recipe.php">➕ Ajouter une Recette</a></h2>

    <h2>Recettes</h2>
    <table class="styled-table">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Catégorie</th>
            <th>Utilisateur</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($recipes as $recipe) : ?>
            <tr>
                <td><?= $recipe['id'] ?></td>
                <td><?= $recipe['title'] ?></td>
                <td><?= $recipe['description'] ?></td>
                <td><?= $recipe['category_id'] ?></td>
                <td><?= $recipe['user_id'] ?></td>
                <td>
                    <a href="edit_recipe.php?id=<?= $recipe['id'] ?>">✏️ Modifier</a> |
                    <a href="delete_recipe.php?id=<?= $recipe['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette recette ?')">❌ Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>