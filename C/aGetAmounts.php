<?php
	$base = isset($base) ? $base : '..';
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	// posts pages
	if($type == "pages"){
		$postsPerPage = 5;	
		include "$base/M/MySql.php";
		DB::openConnection();
		$result = DB::getPostsAmount();
		DB::closeConnection();
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_row($result);
			$postsAmount = $row[0];
		}else{
			$postsAmount = $postsPerPage;
		}
		$pagesAmount = ceil($postsAmount/$postsPerPage);
		echo $pagesAmount;
	}else if($type == "posts"){
		include "$base/M/MySql.php";
		DB::openConnection();
		$result = DB::getPostsAmount();
		DB::closeConnection();
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_row($result);
			$postsAmount = $row[0];
		}else{
			$postsAmount = 1;
		}
		echo $postsAmount;
	}else{
		echo "Error";
	}
?>