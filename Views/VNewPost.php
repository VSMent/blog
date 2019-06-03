<?php 

class VNewPost extends View
{
    public static function loadMain($param)
    {
    	$postTitle = $param['postTitle'];
    	$postText = $param['postText'];
    	$postError = $param['postError'];
        include './Src/Templates/newPost.php';  
    }   
        
}

