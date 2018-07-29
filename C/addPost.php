<?php
	$base = isset($base) ? $base : '..';
	include "$base/M/Globals.php";
	include "$base/M/MySql.php";

	// $title = filter_input(INPUT_POST, variable_name)
	$title = $_POST['postTitle'];
	$text = $_POST['postText'];

	DB::openConnection();
	if($_FILES['postImage']['error']==0){

		$target_dir = "$base/M/postImages/";
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($_FILES["postImage"]["name"],PATHINFO_EXTENSION));
		$file_name = "img".(DB::getPostsAmount()+1).".$imageFileType";
		$target_file = "$target_dir$file_name";
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["postImage"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["postImage"]["size"] > 1048576) {	// 1 MB
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["postImage"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["postImage"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}else{
		$target_file = "default.png";
	}

	DB::addPost($title,$text,basename($target_file));
	$newPostId = DB::getNewPostId();
	DB::closeConnection();
	header("Location: ".Globals::$root."/V/fullPost.php?post=$newPostId");	// redirect to new post
?>