<header>
	<nav id="global">
		<?php
			if(!isset($active)){
		?>
		<a href="V/newPost.php">New Post</a>
		<a href="index.php">All posts</a>		
		<?php
			}else if($active == 'all'){
		?>
		<a href="V/newPost.php">New Post</a>
		<a href="index.php" class="active">All posts</a>
		<?php
			}else if($active == 'new'){
		?>
		<a href="V/newPost.php" class="active">New Post</a>
		<a href="index.php">All posts</a>		
		<?php
			}
		?>
	</nav>
</header>