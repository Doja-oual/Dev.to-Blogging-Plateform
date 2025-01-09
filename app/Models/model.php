<?php
    namespace App\Models;
    require_once __DIR__. '/../../vendor/autoload.php';
    use  Config\Database;
    
    


class Model{
    private $conn;
    private $table;


    public static function getCountByRelation($mainTable, $relatedTable, $foreignKey) {
        $conn=Database::getConnection(); 
        $sql = "SELECT m.id, m.name, COUNT(r.id) as item_count 
                FROM $mainTable m 
                LEFT JOIN $relatedTable r ON m.id = r.$foreignKey 
                GROUP BY m.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public static function getMostPopular($mainTable, $relatedTable, $foreignKey, $countColumn, $limit = 5) {
        $conn=Database::getConnection(); 
        $sql = "SELECT m.id, m.name, SUM(r.$countColumn) as total_count 
                FROM $mainTable m 
                LEFT JOIN $relatedTable r ON m.id = r.$foreignKey 
                GROUP BY m.id 
                ORDER BY total_count DESC 
                LIMIT $limit";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

      public static function getTrends($mainTable, $relatedTable, $foreignKey, $dateColumn, $daysInterval = 30) {
    $conn=Database::getConnection(); 
       $sql = "SELECT m.name, DATE(r.$dateColumn) as creation_date, COUNT(r.id) as item_count 
                FROM $mainTable m 
                LEFT JOIN $relatedTable r ON m.id = r.$foreignKey 
                WHERE r.$dateColumn >= DATE_SUB(NOW(), INTERVAL $daysInterval DAY) 
                GROUP BY m.name, creation_date 
                ORDER BY creation_date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
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
