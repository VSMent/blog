<?php 

class VFullPost extends View
{

    public static function loadMain($postId)
    {
        $postRows = MPosts::getPost($postId);
        $addClass = "fullPost";
        $exportBtn = '<span id="exportToCSV">Save to CSV</span>'; 
        $postId = $postRows[0]['id'];
        $postTitle = $postRows[0]['title'];
        $postText = $postRows[0]['text'];
        $postImg = $postRows[0]['image'];
        $postTime = $postRows[0]['timestamp'];
        include './Src/Templates/post.php';     
    }   
        
}

