<?php 
// Single Climb With Comments 
// link to this file like this:
	// single-climb.php?climb_id=x
	$climb_id = $_GET['climb_id'];
	require('db-config.php'); //require will kill the page if it doesn't load successfully 
	include_once('functions.php');
	// include('comment-parse.php');
	include('header.php');
?>
<div class="maincontainer">
	<main>
		<?php 
			//get 1 approved climb 
			$query = "SELECT climbs.name, climbs.description, climbs.date, climbs.type, climbs.y_grade, climbs.v_grade, climbs.latitude, climbs.longitude, area.name, users.username, images.image, images.description, images.title, ratings.rating
					FROM users, areas, climbs, images, ratings
					WHERE climbs.is_approved = 1
					AND areas.is_approved = 1
					AND ratings.is_approved = 1

					AND users.user_id = images.user_id 
					AND users.user_id = climbs.user_id 

					AND areas.area_id = climbs.area_id 
					AND areas.area_id = images.area_id 

					AND climbs.climb_id = images.climb_id 
					AND climbs.climb_id = ratings.climb_id 

					AND climbs.climb_id = $climb_id

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
		?>
		<h2>Recent Climbs:</h2>
		<?php
			//loop through climbs found
			while($row = $result->fetch_assoc() ){ 
		?>
		<article>
			<h3><?php echo $row['name']; ?></h3>				
			<div>
				<p>Author: <?php echo $row['username']; ?></p>
				<p>Posted on: <?php echo nice_date($row['date']);?></p>
				<p>Type:<?php echo $row['type']; ?></p></div>
				<p>Grade:<?php echo $row['grade']; ?></p></div>
				<p><?php echo $row['rating']; ?></p></div>
			<p><?php echo $row['description']; ?></p>
		</article>
		<?php
			}//end while loop
			$result->free();

			$query = "SELECT  users.username, comments.body, comments.date 
						 FROM comments, users
						 WHERE comments.climb_id = $climb_id
						 AND comments.is_approved = 1
						 AND users.user_id = comments.user_id
						 ORDER BY date DESC";
		 // run it
		 	$result = $db->query($query);
		 // check it 
		 	if(!$result){
		 		echo $db->error;
		 	}
		 	if( $result->num_rows >= 1){
		?>
		<h2>Comments</h2>
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
				echo '<h2>No comments found yet</h2>';
			}
				include ('comment-form.php');

		} //end if posts found

		else{

			echo 'No posts found';

		}//end if no posts found
		?> 
	</main>
	<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>