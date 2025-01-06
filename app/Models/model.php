<?php
    namespace App\Models;
    require_once '../../vendor/autoload.php';
    use  Config\Database;
    
    
  

class Model{
    private $conn;
    private $table;
    public static function show($table) {
        $conn=Database::getConnection(); 
        $sql = "SELECT * FROM $table ";
        $query = $conn->prepare($sql);
        $query->execute();    
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public static function countItems($table){

        $conn = Database::getInstanse()->getConnection();

        $query = "SELECT COUNT(*) FROM $table";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $users = $stmt->fetch();
        return $users[0];
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
