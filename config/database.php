<?php

class Database {
    private static $host = "localhost";
    private static $db_name = "dev_to_platform";
    private static $username = "root";
    private static $password = "";
    public static $conn;

    public static function getConnection() {
        
        try {
            self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
            self::$conn->exec("set names utf8");
            echo "works";
        } catch(PDOException $exception) {
            echo "Erreur de connexion: " . $exception->getMessage();
        }
        return self::$conn;
    }
}
$conn=new Database();
$conn->getConnection();

?>
