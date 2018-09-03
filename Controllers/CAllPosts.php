<?php 

class CAllPosts extends Controller
{
    public static function loadPage($page)
    {
        $postsAmount = MPosts::getPostsAmount();
        $maxPage = ceil($postsAmount/5);
        if (!intval($page)) {
            header("Location: ".Globals::$host."/page/1");
            exit();
        } else if ($page < 0) {
            header("Location: ".Globals::$host."/page/1");
            exit();
        } else if ($page > $maxPage) {
            header("Location: ".Globals::$host."/page/$maxPage");
            exit();
        } else {
            $realPage = $page-1;
        }
        VAllPosts::showPage('All posts, page '.($realPage+1), 'all', $realPage);    
    }

    public static function returnPage()
    {
        if (isset($_GET['type']) && $_GET['type'] == 'pages') {
            $postsPerPage = 5;  
            $postsAmount = MPosts::getPostsAmount();
            $pagesAmount = ceil($postsAmount/$postsPerPage);
            echo $pagesAmount;
        } else if (isset($_POST['page'])) {
            $postRows = MPosts::getShortPosts($_POST['page']-1);
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

}
