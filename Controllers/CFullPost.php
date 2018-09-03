<?php 

class CFullPost extends Controller
{
    public static function loadPage($postId)
    {
        $postsAmount = MPosts::getPostsAmount();
        if (!intval($postId) || $postId <= 0 || $postId > $postsAmount) {
            header("Location: ".Globals::$host."/page/1");
            exit();
        } else {
            VFullPost::showPage('Post #'.$postId, '', $postId);
        }
    }

    public static function returnPost()
    {
        if (isset($_GET['type']) && $_GET['type'] == 'posts') {   
            $postsAmount = MPosts::getPostsAmount();
            echo $postsAmount;
        } else if (isset($_POST['postId'])) {
            $post = MPosts::getPost($_POST['postId']);
            $addClass = "fullPost";
            $exportBtn = '<span id="exportToCSV">Save to CSV</span>'; 
            $postId = $post[0]['id'];
            $postTitle = $post[0]['title'];
            $postText = $post[0]['text'];
            $postImg = $post[0]['image'];
            $postTime = $post[0]['timestamp'];
            include './Src/Templates/post.php';
        }
    }

    public static function returnCSV()
    {
        $postId = $_POST['postId'];
        $postsAmount = MPosts::getPostsAmount();
        if (!intval($postId) || $postId <= 0 || $postId > $postsAmount) {
            echo "Error";
        } else {
            $post = MPosts::getPost($postId);

            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename=Post'.$postId.'.csv;');

            $file = fopen('php://output', 'w');
            fputcsv(
                $file, 
                array(
                    $post[0]['id'],
                    str_replace( "\n", '\n', str_replace("\r", '\r', $post[0]['title']) ),
                    str_replace( "\n", '\n', str_replace("\r", '\r', $post[0]['text']) ),
                    $post[0]['image'],
                    $post[0]['timestamp']
                )
            );
        }
    }

}
