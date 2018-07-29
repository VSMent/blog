<?php 
	$base = isset($base) ? $base : '..';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="../" >
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css">
	<title>New post</title>
</head>
<body>
	
<?php
	$active = 'new';
	include "$base/V/_header.php";

	$type = 'new';
	include "$base/V/_main.php";
	
	include "$base/V/_footer.php";
?>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
</body>
</html>