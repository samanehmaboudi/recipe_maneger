<?php
require_once 'classes/CRUD.php';
$crud = new CRUD();

$id = $_GET['id'] ?? null;
$table = $_GET['table'] ?? null;

if (!$id || !$table) {
    die("ID ou table non spécifié");
}

$crud->delete($table, $id);
header("Location: index.php");
exit();
