<?php 
	require('db-config.php'); //require will kill the page if it doesn't load successfully 
	include_once('functions.php');
	include('header.php');
	include('aside.php');
	//search zip configuration
		$per_page = 2;
		$current_page = 1; //start page
	//what zip did the user search
	// URL looks like search.php?zip=value
	$zip = mysqli_real_escape_string($db, $_GET['zip']);
	//get all the posts whose title or body match the phrase
	$query = "SELECT post_id, title, body, date 
						FROM posts 
						WHERE is_published = 1
						AND ( title like '%$phrase%' OR body LIKE '%$phrase%' )";
	//run it
	$result = $db->query($query);
	//check it
	if(!$result){
		echo $db->error;
	}
	//how many total posts were found
	$total = $result->num_rows;

?>