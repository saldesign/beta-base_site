<?php 
	require('db-config.php'); //require will kill the page if it doesn't load successfully 
	include_once('functions.php');
?>
	<aside>
<?php 
//	Get 3 recently published shares
$query = "SELECT climbs.name, climbs.description, climbs.v_grade, climbs.y_grade, areas.title,  ratings.rating, users.username
			 FROM climbs, ratings, areas, users
			 WHERE areas.is_approved = 1
			 AND climbs.is_approved = 1
			 AND climbs.area_id = areas.area_id
			 AND climbs.user_id = users.user_id
			 AND climbs.climb_id = ratings.climb_id
			 ORDER BY climbs.date DESC";
// Run query
	$result = $db->query($query);
// If bad result, display db error
	if(!$result){
		die($db->error);
	}
// Check to see if more than one post is found
	if($result->num_rows >= 1){
		//loop through posts found
 ?>
		<section class="module secondary">
			<h4>Recent Shares</h4>
			<?php while($row = $result->fetch_assoc() ){ ?>
			<article class="cf">
				<h5><?php echo $row['name']; ?><span>V<?php echo $row['v_grade']; ?></span></h5>
				<h6><?php echo $row['title'] ?><span class="ratings"><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span></span></h6>
				<p>AUTHOR<span>DATE</span></p>
				<p>A clean, short, 3 move, hand crack on the left most behive boulder</p>
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