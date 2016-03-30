<?php 
	$thisPage="find"; 
	require('db-config.php'); //require will kill the page if it doesn't load successfully 
	include_once('functions.php');
	include('header.php');
//search configuration
	$per_page = 8;
	$current_page = 1; //start page
//what zipcode did the user search
// URL looks like search-result.php?zipcode=value
$zipcode = mysqli_real_escape_string($db, $_GET['zipcode']);
//get all the climbs whose zipcode or description match the zipcode
$query = "SELECT climb_id, zipcode, name, title, climbs.description, climbs.date 
					FROM climbs, areas
					WHERE climbs.is_approved = 1
					AND climbs.area_id = areas.area_id
					AND ( zipcode like '%$zipcode%' OR climbs.description LIKE '%$zipcode%' )";
//run it
$result = $db->query($query);
//check it
if(!$result){
	echo $db->error;
}
//how many total climbs were found
$total = $result->num_rows;
?>





<div class="maincontainer">
	<main>
	<?php if($total >= 1){ 
		//how many total pages do we need. always round up with ceil
		$total_pages = ceil($total/$per_page);

		//what page is the user trying to view?
		//the URL will look like search-result.php?zipcode=x&pages=2
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
				<h2>
				<a href="single.php?climb_id=<?php echo $row['climb_id']; ?>">
					<?php echo $row['name']; ?>
				</a>
				</h2>
				<p><?php echo $row['description']; ?></p>
				<span class="climb-meta"><?php echo nice_date($row['date']); ?></span>
			</article>
			<?php } // end while ?>
			<?php 
			$prev_page = $current_page - 1;
			$next_page = $current_page + 1; ?>
			<section class="pagination">

				<?php if($current_page > 1){ ?>
				<a href="search-result.php?zipcode=<?php echo $zipcode; ?>&amp;page=<?php echo $prev_page; ?>" class="prev">
					Previous Page
				</a>
				<?php }else{ ?>
					<span>Previous Page</span>
				<?php } ?>
				<?php //check if there is a next page
				if( $next_page <= $total_pages ){ ?>
				<a href="search-result.php?zipcode=<?php echo $zipcode; ?>&amp;page=<?php echo $next_page; ?>" class="next">
					Next Page
				</a>
				<?php }else{ ?>
					<span>Next Page</span>
				<?php } ?>

				<?php //Bonus! Numbered Pagination
				$counter = 1;
				while($counter <= $total_pages){
					if( $counter != $current_page){	 ?>
					<a href="search-result.php?zipcode=<?php echo $zipcode; ?>&amp;page=<?php echo $counter; ?>">
						<?php echo $counter ?>
					</a>

					<?php
							}else{
								echo $counter;
							}
						$counter++;
						}//end whilde ?>
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

	