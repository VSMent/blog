<?php 

class VAllPosts extends View
{
    public static function loadMain($page)
    {
        $postRows = MPosts::getShortPosts($page);
        $addClass = "";
        $exportBtn = "";
        for ($i=0; $i < count($postRows); $i++) { 
            $postId = $postRows[$i]['id'];
            $postTitle = $postRows[$i]['title'];
            $postText = $postRows[$i]['short'];
            $postImg = $postRows[$i]['image'];
            $postTime = $postRows[$i]['timestamp'];
            include './Src/Templates/post.php';
        }
    }   
        
}

