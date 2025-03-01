<?php

class CRUD extends PDO {
    public function __construct() {
        parent::__construct('mysql:host=localhost; dbname=recipe_manager; port=3307; charset=utf8', 'root','root');
    }

    public function select($table, $field = 'id', $order = 'ASC') {
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectById($table, $value, $field = 'id') {
        $sql = "SELECT * FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data) {
        $fieldNames = implode(", ", array_keys($data));
        $fieldValues = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($fieldNames) VALUES ($fieldValues)";
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    public function update($table, $data, $id, $id_field = 'id') {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ", ");
        $sql = "UPDATE $table SET $setClause WHERE $id_field = :id";
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

    public function delete($table, $id, $id_field = 'id') {
        $sql = "DELETE FROM $table WHERE $id_field = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}