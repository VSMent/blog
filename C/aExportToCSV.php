<?php
$base = isset($base) ? $base : '..';
include "$base/M/MySql.php";

$postId = intval($_REQUEST['postId']);

DB::openConnection();
$result = DB::getPostById($postId);
DB::closeConnection();

if(mysqli_num_rows($result)==0){
	echo "Error, request returned 0 rows";
}else{
	$row = mysqli_fetch_row($result);

	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=Post'.$postId.'.csv;');

	$file = fopen('php://output', 'w');
	fputcsv(
		$file, 
		array(
			$row[0],
			str_replace( "\n", '\n', str_replace("\r", '\r', $row[1]) )/*title*/,
			str_replace( "\n", '\n', str_replace("\r", '\r', $row[2]) ) /*text*/,
			$row[3],
			$row[4]
		)
	);
}




?>