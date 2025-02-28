<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crud->insert('recipes', [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'instructions' => $_POST['instructions'],
        'category_id' => $_POST['category_id'],
        'user_id' => $_POST['user_id']
    ]);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Recette</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ajouter une Recette</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Titre" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <textarea name="ingredients" placeholder="Ingrédients" required></textarea>
        <textarea name="instructions" placeholder="Instructions" required></textarea>
        <input type="number" name="category_id" placeholder="ID Catégorie" required>
        <input type="number" name="user_id" placeholder="ID Utilisateur" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
