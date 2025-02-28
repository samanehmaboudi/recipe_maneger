<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

$id = $_GET['id'] ?? null;
$table = $_GET['table'] ?? null;

if (!$id || !$table) {
    die("ID ou table non spécifié");
}

$record = $crud->selectById($table, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_POST['update']);
    $crud->update($table, $_POST, $id);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Modifier <?= ucfirst($table) ?></h1>
    <form method="POST">
        <?php foreach ($record as $key => $value): ?>
            <?php if ($key !== 'id'): ?>
                <label><?= ucfirst($key) ?>:</label>
                <input type="text" name="<?= $key ?>" value="<?= htmlspecialchars($value) ?>" required><br>
            <?php endif; ?>
        <?php endforeach; ?>
        <button type="submit" name="update">Mettre à jour</button>
    </form>
</body>
</html>
