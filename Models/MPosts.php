<?php 

class MPosts extends Model
{
    
    // Return array of rows ['id', 'title', ...]
    public static function getShortPosts($page)
    {
        $offset = $page * 5;
        $request = "SELECT * FROM ("
                    . "SELECT `id`, `title`, short_text(`id`) AS short, `image`, `timestamp` FROM posts"
                    . ") AS sub ORDER BY `id` DESC LIMIT $offset, 5";
        return (Database::query($request));
    }

    // Return number, amount of posts
    public static function getPostsAmount()
    {
        $request = "SELECT COUNT(1) AS amount FROM posts";
        $result = Database::query($request);
        return $result[0]['amount'];
    }

    // Return number, id of new post
    public static function insertPost($title, $text, $image)
    {
        $request = "INSERT INTO posts (`title`, `text`, `image`) VALUES ('$title', '$text', '$image')";
        $result = Database::query($request,'id');
        return $result;
    }

    // Return array of one post row ['id', 'title', ...]
    public static function getPost($postId)
    {
        $request = "SELECT `id`, `title`, `text`, `image`, `timestamp` FROM posts WHERE id = $postId";
        return (Database::query($request));
    }

}
