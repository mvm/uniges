<?php

class Connection {
    private static $conn = null;
    private static $host = "localhost";
    private static $username = "uniges";
    private static $password = "uniges";
    private static $dbname = "uniges";
    
    public static function getConnection() {
        if(self::$conn == null) {
            self::$conn = new mysqli(self::$host, self::$username,
                                     self::$password, self::$dbname);
        }
        return self::$conn;
    }
}

?>
