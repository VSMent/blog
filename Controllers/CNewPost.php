<?php 

class CNewPost extends Controller
{
    
    public static function loadPage($param)
    {
        if (isset($_POST['postTitle'])) {
            $title = $_POST['postTitle'];
            $text = $_POST['postText'];

            if ($_FILES['postImage']['error']==0) {

                $target_dir = "./Src/Images/";
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($_FILES["postImage"]["name"],PATHINFO_EXTENSION));
                $result = MPosts::getPostsAmount();
                $imgNumber = $result+1;
                $file_name = "img$imgNumber.$imageFileType";
                $target_file = "$target_dir$file_name";
                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["postImage"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.<br>";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.<br>";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["postImage"]["size"] > 1048576) {   // 1 MB
                    echo "Sorry, your file is too large. (".round($_FILES["postImage"]["size"]/1048576,2)."Mb / 1Mb)<br>";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Your file was not uploaded.<br>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["postImage"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["postImage"]["name"]). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.<br>";
                    }
                }
            } else {
                $target_file = "default.png";
            }
            if(isset($uploadOk) && $uploadOk == 1){
                $postId = MPosts::insertPost($title,$text,basename($target_file));
                header("Location: ".Globals::$host."/post/$postId"); // redirect to new post
                exit();
            }else{
                $param = array();
                $param['postTitle'] = $_POST['postTitle'];
                $param['postText'] = $_POST['postText'];
                $param['postError'] = "File is too large. (".round($_FILES["postImage"]["size"]/1048576,2)."Mb / 1Mb)";
                VNewPost::showPage('New post', 'new', $param);
            }
        } else {
            VNewPost::showPage('New post', 'new', $param);
        }
    }

}
