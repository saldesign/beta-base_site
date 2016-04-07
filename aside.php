<?php 
	require('db-config.php'); //require will kill the page if it doesn't load successfully 
	include_once('functions.php');
?>
	<aside>
		<section class="module secondary">
			<h4 class="bar_underline">Recent Shares</h4>
<?php 
//	Get 5 recently published shares
$query = "SELECT climbs.name, climbs.climb_id, climbs.description, climbs.v_grade, climbs.y_grade, climbs.date, areas.area_id, areas.title, users.username
			 FROM climbs, areas, users
			 WHERE areas.is_approved = 1
			 AND climbs.is_approved = 1
			 AND climbs.area_id = areas.area_id
			 AND climbs.user_id = users.user_id
			 ORDER BY climbs.date DESC
			 LIMIT 5";
// Run query
	$result = $db->query($query);
// If bad result, display db error
	if(!$result){
		die($db->error);
	}
// Check to see if more than one climb is found
	if($result->num_rows >= 1){
		//loop through posts found
 ?>
			<?php while($row = $result->fetch_assoc() ){
			$climb_id = $row['climb_id']; ?>
			<article class="cf">
				<h5><a href="single-climb.php?climb_id=<?php echo $climb_id; ?>"><?php echo $row['name']; ?></a><span><?php
						if($row['v_grade'] == NULL){
							echo $row['y_grade'];
						}else{
							echo $row['v_grade'];
						}					
					?></span></h5>
				<h6><a href="single-area.php?area_id=<?php echo $row['area_id']; ?>"><?php echo $row['title']; ?></a>
				<span class="ratings"><?php 
				$rating_query = "SELECT AVG(rating) AS average FROM ratings WHERE climb_id = $climb_id";
				$rating_result = $db->query($rating_query);
				$rating_row = $rating_result->fetch_assoc();
				echo round($rating_row['average']);
				 ?><span class="icon-star"></span></span></h6>
				<p><?php echo $row['username']; ?><span><?php echo nice_date($row['date']); ?></span></p>
				<p><?php echo substr($row['description'], 0, 90); ?></p>
				<a href="#" class="btn">Read More...</a>
			</article>
<?php
		}//end while loop
	} //end if posts found
	else{
		echo 'No posts found';
	}//end if no posts found
?> 
</section>

<!-- Not a part of MVP -->
<!-- 		<section class="module secondary">
			<h4>Recent Climbs</h4>
			<article>
				<h5>CLIMB NAME<span>GRADE</span></h5>
				<h6>AREA<span class="rating">RATING</span></h6>
				<p>AUTHOR<span>TICKS</span></p>
			</article>
			<article>
				<h5>CLIMB NAME<span>GRADE</span></h5>
				<h6>AREA<span class="rating">RATING</span></h6>
				<p>AUTHOR<span>TICKS</span></p>
			</article>
			<article>
				<h5>CLIMB NAME<span>GRADE</span></h5>
				<h6>AREA<span class="rating">RATING</span></h6>
				<p>AUTHOR<span>TICKS</span></p>
			</article>
		</section> -->
	</aside>