<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID non spécifié");
}

$recipe = $crud->selectById('recipes', $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_POST['update']);
    $crud->update('recipes', $_POST, $id);
    header("Location: index.php");
    exit();
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
        <input type="number" name="category_id" value="<?= $recipe['category_id'] ?>" required>
        <input type="number" name="user_id" value="<?= $recipe['user_id'] ?>" required>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
