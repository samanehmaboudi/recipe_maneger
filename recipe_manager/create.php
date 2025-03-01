<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $crud->insert('users', [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);
    } elseif (isset($_POST['add_category'])) {
        $crud->insert('categories', ['name' => $_POST['name']]);
    } elseif (isset($_POST['add_recipe'])) {
        $crud->insert('recipes', [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'ingredients' => $_POST['ingredients'],
            'instructions' => $_POST['instructions'],
            'category_id' => $_POST['category_id'],
            'user_id' => $_POST['user_id']
        ]);
    } elseif (isset($_POST['add_comment'])) {
        $crud->insert('comments', [
            'user_id' => $_POST['user_id'],
            'recipe_id' => $_POST['recipe_id'],
            'message' => $_POST['message']
        ]);
    }
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter des données</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ajouter des données</h1>
    
    <h2>Nouvel utilisateur</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit" name="add_user">Ajouter</button>
    </form>
    
    <h2>Nouvelle catégorie</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nom de la catégorie" required>
        <button type="submit" name="add_category">Ajouter</button>
    </form>
    
    <h2>Nouvelle recette</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Titre" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <textarea name="ingredients" placeholder="Ingrédients" required></textarea>
        <textarea name="instructions" placeholder="Instructions" required></textarea>
        <input type="number" name="category_id" placeholder="ID Catégorie" required>
        <input type="number" name="user_id" placeholder="ID Utilisateur" required>
        <button type="submit" name="add_recipe">Ajouter</button>
    </form>
    
    <h2>Nouveau commentaire</h2>
    <form method="POST">
        <input type="number" name="user_id" placeholder="ID Utilisateur" required>
        <input type="number" name="recipe_id" placeholder="ID Recette" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit" name="add_comment">Ajouter</button>
    </form>
</body>
</html>
