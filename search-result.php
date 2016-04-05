<?php 
	include('userheader.php');
	$thisPage="find"; 
	include('header.php');
//search configuration
	$per_page = 8;
	$current_page = 1; //start page
//what phrase did the user search
// URL looks like search-result.php?phrase=value
$phrase = mysqli_real_escape_string($db, $_GET['phrase']);
//get all the climbs whose name or description or  match the phrase
$query = "SELECT climbs.climb_id, climbs.type, areas.area_id, zipcode, name, title, climbs.description, climbs.date
					FROM climbs, areas
					WHERE climbs.is_approved = 1
					AND areas.is_approved = 1
					AND climbs.area_id = areas.area_id
					AND ( name like '%$phrase%'
					 OR climbs.description LIKE '%$phrase%'
					 OR climbs.type LIKE '%$phrase%'
					 OR climbs.v_grade LIKE '%$phrase%'
					 OR climbs.y_grade LIKE '%$phrase%'
					 OR areas.title LIKE '%$phrase%'
					 OR areas.description LIKE '%$phrase%'
					 OR areas.zipcode LIKE '%$phrase%'
					  )";
//run it
$result = $db->query($query);
//check it
if(!$result){
	echo $db->error;
}
//how many total climbs or areas were found
$total = $result->num_rows;
?>
<div class="maincontainer">
	<main>
	<?php if($total >= 1){ 
		//how many total pages do we need. always round up with ceil
		$total_pages = ceil($total/$per_page);

		//what page is the user trying to view?
		//the URL will look like search-result.php?phrase=x&pages=2
		if($_GET['page']) {
			$current_page = $_GET['page'];
		}
		//make sure viewing a valid page
		if( $current_page <= $total_pages){ 
			//calculate offset for LIMIT
			$offset = ($current_page - 1) * $per_page;

			//modify the original query
			$query .= " limit $offset, $per_page";

			//run it again
			$result = $db->query($query);
		?>
		<section class="module">
			<h2><?php echo $total; ?> Climbs</h2>
			<h3>Viewing Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></h3>
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<article>
				<h2><a href="single-climb.php?climb_id=<?php echo $row['climb_id']; ?>">
					<?php echo $row['name']; ?></a></h2>
				<p><?php echo $row['description']; ?></p>
				<span class="climb-meta"><?php echo nice_date($row['date']); ?></span>
			</article>
			<?php } // end while ?>
			<?php 
			$prev_page = $current_page - 1;
			$next_page = $current_page + 1; ?>
			<section class="pagination">

				<?php if($current_page > 1){ ?>
				<a href="search-result.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $prev_page; ?>" class="prev">
					Previous Page
				</a>
				<?php }else{ ?>
					<span>Previous Page</span>
				<?php } ?>
				<?php //check if there is a next page
				if( $next_page <= $total_pages ){ ?>
				<a href="search-result.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $next_page; ?>" class="next">
					Next Page
				</a>
				<?php }else{ ?>
					<span>Next Page</span>
				<?php } ?>

				<?php //Bonus! Numbered Pagination
				$counter = 1;
				while($counter <= $total_pages){
					if( $counter != $current_page){	 ?>
					<a href="search-result.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $counter; ?>">
						<?php echo $counter ?>
					</a>

					<?php
							}else{
								echo $counter;
							}
						$counter++;
						}//end while ?>
			</section>



			<?php 
				}//end if valid page
				else{
					echo 'Invalid page';
				}
				//end if climbs found
				}else{
				echo "no climbs found";
				} ?>
		</section>			



	</main>
<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>

	