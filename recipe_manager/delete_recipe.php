<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID non spécifié");
}

$crud->delete('recipes', $id);
header("Location: index.php");
exit();
