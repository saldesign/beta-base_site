<?php 
	//convert datetime format to nice looking date
	function nice_date( $datetime ){
		$date = new DateTime( $datetime );
		return $date->format('l,  F j');
	}


//convert datetime format to RFC 822 format for the feed
function rss_date( $datetime ){
	$date = new DateTime( $datetime );
	return $date->format( 'r' );
}

//count the comments on any one climb
//$climb_id = INT the climb you are counting comments for
function count_comments( $climb_id ){
	global $db;
	//count the approved comments on climb #2
	$query = "SELECT COUNT(*) AS total
						FROM comments
						WHERE climb_id = $climb_id
						AND is_approved = 1";
	//run it
	$result = $db->query($query);
	//check it
	if( $result->num_rows >= 1 ){
		//loop it
		while( $row = $result->fetch_assoc() ){
			echo $row['total'];
		}
		//free it
		$result->free();
	}//end if
}//end count_comments() 

//Use for hilighting form fields with an error
function field_error($problem){
	if(isset($problem)){
		echo 'class="error"';
	}
}

//count the number of climbs that any user has
//@param $user_id = int. the ID of any user
//@param $is_approved = BOOLEAN. 1 = published climbs (default)
//											0 = drafts
//@return int. the total number of climbs
function count_climbs( $user_id, $is_approved = 1){
	global $db;
	$query = "SELECT COUNT(*) AS total
				FROM climbs 
				WHERE user_id = $user_id
				AND is_approved = $is_approved";
	$result = $db->query($query);
	// count will return one value / row
	if(! $result){
		echo $db->error;
	}
	$row = $result->fetch_assoc();
	return $row['total'];
}

/**
 * Show the climb written by any user with the most comments
 * @param $user_id int.  Any user id.
 * @return string. the title and number of comments on that climb
 * @author Christian
 * @see https://www.phpdoc.org/
 */
function most_popular_climb( $user_id){
	global $db;
	$query = "SELECT COUNT(*) AS total, climbs.title
					FROM comments, climbs
					WHERE comments.climb_id = climbs.climb_id
					AND climbs.user_id = $user_id
					GROUP BY climbs.climb_id
					ORDER BY total DESC
					LIMIT 1";
	$result = $db->query($query);
	if(! $result){
		echo $db->error;
	}
	if($result->num_rows == 1){
		//popular climbs found! return the title of the climb
		$row = $result->fetch_assoc()
;		return $row['title'] . '(' . $row['total'] . ')';
	}else{
		return 'Your climbs do not have any comments yet.';
	}
}

/**
	*Helper for checking a checkbox if two values match
*/
function checked($thing1, $thing2){
	if($thing1 == $thing2){
		echo 'checked';
	}
}
/**
	*Helper for selecting an option in a dropdown if two values match
*/
function selected($thing1, $thing2){
	if($thing1 == $thing2){
		echo 'selected';
	}
}
