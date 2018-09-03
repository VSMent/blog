<?php 

class Database
{
    public static $host = "localhost";
    public static $username = "root";
    public static $password = "root";
    public static $dbName = "blog";

    private static $con;
    public static function openConnection()
    {
        if (!isset(self::$con)) {
            self::$con = mysqli_connect(self::$host, self::$username, self::$password, self::$dbName);
            if (mysqli_connect_error()) {
                printf("DB connection error: %s\n", mysqli_connect_error());
                return false;
            }
            mysqli_query(self::$con, "set names utf8mb4");
        }
        return true;
    }

    public static function closeConnection()
    {
        mysqli_close(self::$con);
    }

    // Return array of rows or string error
    public static function query($query, $returnType = 'row')
    {
        if (self::openConnection()) {
            $result = mysqli_query(self::$con, $query);
            if ($returnType == 'row') {
                if ($result) {
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                } else {
                    $rows = "DB error: ".mysqli_error(self::$con);
                }
                return $rows;
            } else if ($returnType == 'id') {
                return mysqli_insert_id(self::$con);
            }
        } else {
            return "Error, can not connect to db";
        }

    }

}
