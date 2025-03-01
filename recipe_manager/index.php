<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

// Charger toutes les catégories et les utilisateurs
$usersList = $crud->select('users');
$categoriesList = $crud->select('categories');

// Créer des tableaux associatifs id -> name
$userNames = [];
foreach ($usersList as $user) {
    $userNames[$user['id']] = $user['name'];
}

$categoryNames = [];
foreach ($categoriesList as $category) {
    $categoryNames[$category['id']] = $category['name'];
}

// Charger les recettes
$recipes = $crud->select('recipes');
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
        <!-- Remplacer l'ID de catégorie par son nom -->
        <td><?= $categoryNames[$recipe['category_id']] ?></td>
        <!-- Remplacer l'ID d'utilisateur par son nom -->
        <td><?= $userNames[$recipe['user_id']] ?></td>
        <td>
            <a href="edit_recipe.php?id=<?= $recipe['id'] ?>">✏️ Modifier</a> |
            <a href="delete_recipe.php?id=<?= $recipe['id'] ?>" onclick="return confirm('...')">🗑️ Supprimer</a>
        </td>
    </tr>
<?php endforeach; ?>

    </table>
</body>
</html>