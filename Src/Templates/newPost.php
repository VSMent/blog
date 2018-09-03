<table id="newPost">
	<form method="POST" action="/newPost" enctype="multipart/form-data">
		<tbody>
			<tr>
				<td><label for="postTitle">Title</label></td>
				<td><input id="postTitle" name="postTitle" type="text" maxlength="100" required></td>
			</tr>
			<tr>
				<td><label for="postText">Text</label></td>
				<td><textarea id="postText" name="postText" cols="30" rows="5" maxlength="10000" required></textarea></td>
			</tr>
			<tr>
				<td><label for="postImage">Image</label></td>
				<td><input id="postImage" name="postImage" type="file" accept=".png,.jpg,.jpeg,.gif"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit"></td>
			</tr>
		</tbody>
	</form>
</table>