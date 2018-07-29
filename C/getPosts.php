<?php
	$base = isset($base) ? $base : '..';
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
	include "$base/M/MySql.php";
	DB::openConnection();
	$result = DB::getShortPosts(($page-1) * 5);
	if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_row($result)) {
			$postId = $row[0];
			$postTitle = nl2br($row[1]);
			$postText = nl2br($row[2]) . '...';
			$postImg = $row[3];
			$postTime = $row[4];

			$addClass = '';
			$exportBtn = '';
			include "$base/V/_post.php";
	    }
	}else{
		$postId = '';
		$postTitle = 'Server';
		$postText = 'There is no posts yet';
		$postImg = 'default.png';
		$postTime = date('Y-m-d H:i:s',time());

		$addClass = '';
		$exportBtn = '';
		include "$base/V/_post.php";
	}
    echo "<input type=\"hidden\" id=\"currentPage\" value=\"$page\">";
	DB::closeConnection();

?>