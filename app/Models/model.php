<?php
      
require_once __DIR__. '../config/database.php';

class Model{
    private $conn;
    private $table;

    public static function show($table) {
        $con=Database::getConnection(); 
        $sql = "SELECT * FROM $table ";
        $query = $con->prepare($sql);
        $query->execute();    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public  static function add($table,$data) {
        $con=Database::getConnection();
        $columns = implode(",", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));  
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $con->prepare($sql);
    
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value); }
        return $stmt->execute();
    }


    public static function update($table,$id, $data) {
        $con=Database::getConnection();

        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $sql = "UPDATE $table SET $fields WHERE id = :id";

        $stmt = $con->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public static  function delete($table,$id) {
        $con=Database::getConnection();
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
    
}


?>
