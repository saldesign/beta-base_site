<article id="comment-form">
	<h4>Leave a comment:</h4>
	<?php 
	//parser feedback
	if(isset($message)){
		echo '<div class="message">' . $message . '</div>';
	}
	 ?>
	<form action="#comment-form" method="post">
		<label for="body">Comment:</label>
		<textarea name="body" id="body"></textarea>
		<input type="submit" value="Save Comment">
		<input type="hidden" name="did_comment" value="1">
	</form>
</article>