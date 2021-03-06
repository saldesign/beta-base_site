<?php 
	include('userheader.php'); 
	signedin();
// Single Climb With Comments 
// link to this file like this:
	// single-climb.php?climb_id=x
	$climb_id = $_GET['climb_id'];
	//TODO: set this page to current climb
	include('header.php');
	include('comment-parse.php');
	include('image-parser.php');
?>
<div class="maincontainer">
	<main>
		<section class="module">

		<?php 
			//get 1 approved climb 
			$query = "SELECT climbs.name, climbs.description, climbs.date, climbs.type, climbs.y_grade, climbs.v_grade, areas.title, users.username
					FROM users, areas, climbs
					WHERE climbs.is_approved = 1
					AND areas.is_approved = 1

					AND users.user_id = climbs.user_id 

					AND areas.area_id = climbs.area_id 

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

			//loop through climbs found
			while($row = $result->fetch_assoc() ){ 
			?>
				<h2><?php echo $row['name']; ?></h2>				
				<h3 class="bar_underline"><?php echo $row['title']; ?></h3>	

				<form action="#" method="post">
					<label>Rate this climb: 1 - 5 Stars</label>
						<div id="display-area"></div>
						<span class="star-rating">
						  <input type="radio" name="rating" value="1" data-id="<?php echo $climb_id; ?>"><i></i>
						  <input type="radio" name="rating" value="2" data-id="<?php echo $climb_id; ?>"><i></i>
						  <input type="radio" name="rating" value="3" data-id="<?php echo $climb_id; ?>"><i></i>
						  <input type="radio" name="rating" value="4" data-id="<?php echo $climb_id; ?>"><i></i>
						  <input type="radio" name="rating" value="5" data-id="<?php echo $climb_id; ?>"><i></i>
						</span>
				</form>

				<div>
					<p>Author: <?php echo $row['username']; ?></p>
					<p>Posted on: <?php echo nice_date($row['date']);?></p>
					<p>Type:<?php echo $row['type']; ?></p>
					<p>Grade:<?php
						if($row['v_grade'] == NULL){
							echo $row['y_grade'];
						}else{
							echo $row['v_grade'];
						}					
					?></p>
					<p><?php echo $row['rating']; ?></p>
					<p><?php echo $row['description']; ?></p>
				</div>
			<?php
				}//end while loop
				$result->free();
				show_pic_climb($climb_id, 'medium');
				if(defined('IS_LOGGED_IN')==true){
					include ('image-form.php');
				}
				$query = "SELECT  comments.body, users.username, comments.date
							 FROM comments, users
							 WHERE comments.climb_id = $climb_id
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
			if(defined('IS_LOGGED_IN')==true){
			include ('comment-form.php');	
			}

			?> 
		</section>
	</main>
	<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>