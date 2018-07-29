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

// function checkAdminExistDB($con, $email) {
//     $exist = false;
//     if ($con) {
//         $request = "SELECT a.id FROM administrators a JOIN users u ON u.id = a.user_id WHERE active = '1' AND email='" . $email . "'";
//         if ($result = mysqli_query($con, $request)) {
//             if (mysqli_num_rows($result) > 0) {
//                 $exist = true;
//             }
//             mysqli_free_result($result);
//         }
//     }
//     return $exist;
// }

// function checkAdminDB($con, $user, $password) {
//     $id = false;
//     if ($con) {
//         $request = "SELECT a.id FROM administrators a JOIN users u ON u.id = a.user_id WHERE active = '1' AND email='" . $user . "' and password='" . $password . "'";
//         if ($result = mysqli_query($con, $request)) {
//             if (mysqli_num_rows($result) > 0) {
//                 $row = mysqli_fetch_row($result);
//                 $id = $row[0];
//             } else {
//                 $id = -1;
//             }
//             mysqli_free_result($result);
//         }
//     }
//     return $id;
// }


// function getUserById($con, $id) {
//     if ($con) {
//         $request = "SELECT * FROM users WHERE id = '$id'";
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function updateUser($con, $email, $password, $name, $surname, $phone, $country, $city, $address, $passport, $active, $id) {
//     if ($con) {
//         $request = "UPDATE users SET "
//                 . "email = '"
//                 . $email . "', "
//                 . "password = '"
//                 . $password . "', "
//                 . "name = '"
//                 . $name . "', "
//                 . "surname = '"
//                 . $surname . "', "
//                 . "phone = '"
//                 . $phone . "', "
//                 . "country = '"
//                 . $country . "', "
//                 . "city = '"
//                 . $city . "', "
//                 . "address = '"
//                 . $address . "', "
//                 . "passport = '"
//                 . $passport . "', "
//                 . "active = '"
//                 . $active . "' "
//                 . "WHERE id = "
//                 . $id;
// //        echo $request;
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function getProducts($con) {
//     if ($con) {
//         $request = "SELECT * FROM products";
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function getProductById($con, $id) {
//     if ($con) {
//         $request = "SELECT * FROM products WHERE id = '$id'";
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function updateProduct($con, $name, $description, $price, $inPack, $stock, $image, $active, $id) {
//     if ($con) {
//         $request = "UPDATE products SET "
//                 . "name = '"
//                 . $name . "', "
//                 . "description = '"
//                 . $description . "', "
//                 . "price = '"
//                 . $price . "', "
//                 . "in_pack = '"
//                 . $inPack . "', "
//                 . "stock = '"
//                 . $stock . "', "
//                 . "image = '"
//                 . $image . "', "
//                 . "active = '"
//                 . $active . "' "
//                 . "WHERE id = "
//                 . $id;
// //        echo $request;
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function addProduct($con, $name, $description, $price, $inPack, $stock, $image, $active) {
//     if ($con) {
//         $request = "INSERT INTO products ("
//                 . "name, "
//                 . "description, "
//                 . "price, "
//                 . "in_pack, "
//                 . "stock, "
//                 . "image, "
//                 . "active) "
//                 . "VALUES ('"
//                 . $name . "', '"
//                 . $description . "', '"
//                 . $price . "', '"
//                 . $inPack . "', '"
//                 . $stock . "', '"
//                 . $image . "', '"
//                 . $active . "')";
//         echo $request;
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function getPurchases($con) {
//     if ($con) {
// //        $request = "SELECT id, total_price, date, status FROM purchases ORDER BY id DESC";
//         $request = "SELECT p.user_id, p.id, p.date, p.total_price, p.status, pr.id, pr.name, d.amount, d.price FROM purchases p JOIN details d On p.id = d.purchase_id JOIN products pr ON pr.id = d.product_id ORDER BY p.user_id, p.id";
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function getPurchasesByUserId($con, $userId) {
//     if ($con) {
//         $request = "SELECT p.user_id, p.id, p.date, p.total_price, p.status, pr.id, pr.name, d.amount, d.price FROM purchases p JOIN details d On p.id = d.purchase_id JOIN products pr ON pr.id = d.product_id WHERE p.user_id = $userId ORDER BY p.user_id, p.id";
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function getPurchasesByProductId($con, $productId) {
//     if ($con) {
//         $request = "SELECT p.user_id, p.id, p.date, p.total_price, p.status, pr.id, pr.name, d.amount, d.price FROM purchases p JOIN details d On p.id = d.purchase_id JOIN products pr ON pr.id = d.product_id WHERE pr.id = $productId ORDER BY p.user_id, p.id";
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function getPurchasesByDate($con, $date) {
//     if ($con) {
//         $request = "SELECT p.user_id, p.id, p.date, p.total_price, p.status, pr.id, pr.name, d.amount, d.price FROM purchases p JOIN details d On p.id = d.purchase_id JOIN products pr ON pr.id = d.product_id WHERE p.date LIKE '$date%' ORDER BY p.user_id, p.id";
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }

// function updatePurchase($con, $status, $id) {
//     if ($con) {
//         $request = "UPDATE purchases SET "
//                 . "status = '"
//                 . $status . "' "
//                 . "WHERE id = "
//                 . $id;
// //        echo $request;
//         $result = mysqli_query($con, $request);
//         return $result;
//     }
// }


?>