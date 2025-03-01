<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID non spécifié");
}

$recipe = $crud->selectById('recipes', $id);

// Récupérer toutes les catégories et les utilisateurs
$categoriesList = $crud->select('categories');
$usersList = $crud->select('users');

// Créer des tableaux associatifs id -> name
$categoryNames = [];
foreach ($categoriesList as $category) {
    $categoryNames[$category['id']] = $category['name'];
}

$userNames = [];
foreach ($usersList as $user) {
    $userNames[$user['id']] = $user['name'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Recette</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Modifier une Recette</h1>
    <form method="POST">
        <input type="text" name="title" value="<?= $recipe['title'] ?>" required>
        <textarea name="description" required><?= $recipe['description'] ?></textarea>
        <textarea name="ingredients" required><?= $recipe['ingredients'] ?></textarea>
        <textarea name="instructions" required><?= $recipe['instructions'] ?></textarea>
        <select name="category_id">
    <?php foreach ($categoryNames as $id => $name) : ?>
        <option value="<?= $id ?>" <?= $id == $recipe['category_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($name) ?>
        </option>
    <?php endforeach; ?>
</select>

<select name="user_id">
    <?php foreach ($userNames as $id => $name) : ?>
        <option value="<?= $id ?>" <?= $id == $recipe['user_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($name) ?>
        </option>
    <?php endforeach; ?>
</select>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
