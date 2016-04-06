<?php 
	include('userheader.php'); 
	signedin();
// Single Climb With Comments 
// link to this file like this:
	// single-climb.php?climb_id=x
	$area_id = $_GET['area_id'];
	//TODO: set this page to current area
	include('header.php');
	include('comment-parse.php');
	include('image-parser.php');
?>

<div class="maincontainer">
	<main>
		<section class="module">

		<?php 
			//get 1 approved area 
			$query = "SELECT areas.title, areas.description, areas.date, areas.zipcode, areas.longitude, areas.latitude, climbs.name,	areas.user_id, climbs.type, climbs.v_grade, climbs.y_grade, users.username
					FROM users, areas, climbs
					WHERE climbs.is_approved = 1
					AND areas.is_approved = 1

					AND users.user_id = areas.user_id 

					AND areas.area_id = climbs.area_id 

					AND areas.area_id = $area_id

					ORDER BY climbs.date DESC
					LIMIT 1";
		//run query
			$result = $db->query($query);
		//if the result is bad, show us the db error message
			if(!$result){
				die($db->error);
			}


		//check to see if more than 1 climb was found
			if($result->num_rows >= 1){

			//loop through climbs found
			while($row = $result->fetch_assoc() ){ 
			?>
				<h2><?php echo $row['title']; ?></h2>				
				<div>
					<p>Author: <?php echo $row['username']; ?></p>
					<p>Posted on: <?php echo nice_date($row['date']);?></p>
					<p>Zip Code:<?php echo $row['zipcode']; ?></p>
					<p>Longitude:<?php echo $row['longitude']; ?></p>
					<p>Latitude:<?php echo $row['latitude']; ?></p>
					<p><?php echo $row['description']; ?></p>
				</div>
			<?php
				}//end while loop
				$result->free();
				show_pic_area($area_id, 'medium');
				if(defined('IS_LOGGED_IN')){
					include ('image-form.php');	
				}	

				$query = "SELECT  comments.body, users.username, comments.date, users.user_id
							 FROM comments, users
							 WHERE comments.area_id = $area_id
							 AND users.user_id = comments.user_id
							 AND comments.is_approved = 1
							 ORDER BY date DESC";
			 // run it
			 	$result = $db->query($query);
			 // check it 
			 	if(!$result){
			 		echo $db->error;
			 	}
			 	if( $result->num_rows >= 1){
			?>
			<ul>
				<?php while( $row = $result->fetch_assoc() ){ ?>
				<li>

					<h3><?php echo $row['username']; ?> 
					on <?php echo nice_date($row['date']); ?></h3>
					<p><?php echo $row['body'] ?></p>
				</li>
				<?php } // end while 
				$result->free() ?>
			</ul>
			<?php 
				}//end if comments found
				else{
					echo '<h4>No comments found</h4>';
				}
			} //end if climbs found
			else{
				echo 'No climbs found';
			}//end if no climbs found
			if(defined('IS_LOGGED_IN')){
				include ('comment-form.php');	
			}	
			?> 
		</section>
	</main>
	<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>