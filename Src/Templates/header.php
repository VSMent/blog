<header>
	<nav id="global">
		<?php
			if ($active == '') {
		?>
		<a href="/newPost">New Post</a>
		<a href="/page/1">All posts</a>		
		<?php
			} else if ($active == 'all') {
		?>
		<a href="/newPost">New Post</a>
		<a href="/page/1" class="active">All posts</a>
		<?php
			} else if ($active == 'new') {
		?>
		<a href="/newPost" class="active">New Post</a>
		<a href="/page/1">All posts</a>		
		<?php
			}
		?>
	</nav>
</header>