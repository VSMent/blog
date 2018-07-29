<?php
	$base = isset($base) ? $base : '..';
	$postId = isset($_REQUEST['post']) ? $_REQUEST['post'] : 1;
	$postId = intval($postId);

	if($postId <= 0){
		echo 'Error, no such post with id '.$postId;
	}else{
		include "$base/M/MySql.php";
		DB::openConnection();
		$result = DB::getPostById($postId);
		DB::closeConnection();

		if(mysqli_num_rows($result)==0){
			echo 'Error, MySQL returned 0 rows';
		}else{
			$row = mysqli_fetch_row($result);

			$postId = $row[0];
			$postTitle = nl2br($row[1]);
			$postText = nl2br($row[2]);
			$postImg = $row[3];
			$postTime = $row[4];
			
			$addClass = "fullPost";
			$exportBtn = '<span id="exportToCSV">Save to CSV</span>';
			include "$base/V/_post.php";
		}
	}
?>