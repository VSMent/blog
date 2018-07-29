<?php 
	$base = isset($base) ? $base : '.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href=".">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css">
	<title>Home Page</title>
</head>
<body>
<?php
	$active = 'all';
	include "$base/V/_header.php";

	$type = 'all';
	include "$base/V/_main.php";
	include "$base/V/_footer.php";
?>
<form action="V/fullPost.php" method="GET" style="display: none;">
	<input id="postIDValue" type="hidden" name="post">
	<input id="postIDSubmit" type="submit">
</form>
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>
  <script src="js/index.js"></script>
</body>
</html>