<?php
class DB
{
    static $con;
    static function openConnection() {
        if(!isset(self::$con)){
            self::$con = mysqli_connect("localhost", "root", "root", "blog");
            if (mysqli_connect_error()) {
                printf("DB connection error: %s\n", mysqli_connect_error());
                return false;
            }
            mysqli_query(self::$con, "set names utf8mb4");
        }
        return true;
    }

    static function closeConnection() {
        mysqli_close(self::$con);
    }

    static function addPost($title, $text, $image) {
        if (self::$con) {
            $request = "INSERT INTO posts ("
                    . "title, "
                    . "text, "
                    . "image) "
                    . "VALUES ('"
                    . $title . "', '"
                    . $text . "', '"
                    . $image . "')";
            $result = mysqli_query(self::$con, $request);
            return $result;
        }
    }

    static function getNewPostId() {
        if (self::$con) {
            return mysqli_insert_id(self::$con);
        }
    }

    static function getPostsAmount() {
        if (self::$con) {
            $request = "SELECT COUNT(1) FROM posts";
            $result = mysqli_query(self::$con, $request);
            return $result;
        }
    }


    static function getShortPosts($offset) {
        if (self::$con) {
            $offset = $offset < 0 ? 0 : $offset;
            $request = "SELECT * FROM ("
                            . "SELECT `id`, `title`, short_text(`id`) AS short, `image`, `timestamp` FROM posts"
                        . ") AS sub LIMIT $offset, 5";
            $result = mysqli_query(self::$con, $request);
            return $result;
        }
    }

    static function getPostById($id) {
        if (self::$con) {
            $request = "SELECT *  FROM posts WHERE id = $id";
            $result = mysqli_query(self::$con, $request);
            return $result;
        }
    }
}
?>