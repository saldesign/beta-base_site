<?php 
//This file handles Inserting one comment into the DB
if($_POST['did_comment']){
	//extract and sanitize the form data
	$body = strip_tags(mysqli_real_escape_string($db, $_POST['body']));
	//TODO: make this work with the logged in user
	// $user_id=3;
	//validate it
	$valid = true;
	if($body == ''){
		$valid = false;
	}
	//if valid, add to db
	if($valid){
		 $query = "INSERT INTO comments
							( body, user_id, date, is_approved, climb_id )
							VALUES
							( '$body', ".USER_ID.", now(), 1, $climb_id )";
		// run it
		$result = $db->query($query);

		//check it
		if(!$result){
			echo $db->error;
		}
		//give the user feedback
		if( $db->affected_rows >= 1){
			$message = 'thanks for your comment';
		}else{
			$message = 'Your comment was not saved';
		}
	}


	}

// no close PHP