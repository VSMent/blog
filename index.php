<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css">
	<title>Home Page</title>
</head>
<body>

<?php
	include 'pages/_header.php';
?>
	<section>
		<aside id="left"></aside>
		<main>
			
			<!-- posts -->
<?php
	include 'pages/_post.php';
?>

		</main>
		<aside id="right"></aside>
	</section>

<?php
	include 'pages/_footer.php';
?>

</body>
</html>