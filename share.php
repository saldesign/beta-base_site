<?php 
	require('db-config.php'); //require will kill the page if it doesn't load successfully 
	$thisPage="share";
	include('header.php'); 
	include_once('functions.php');
?>

<div class="maincontainer">
	<main>
		<section class="module banner">
		<h2>
			<span>share climbs and areas</span>
			<span><a href="share-area.php">AREAS </a> mark the general location of a crag</span>
			<span><a href="share-climb.php">CLIMBS </a> describe the beta and other details</span>
		</h2>
		</section>

			<div class="quicklinks cf">
				<div class="container">
					<div class="wrapper">
						<section class="module">
							<h3><span>Areas</span></h3>
							<div> 
								<p class="cf">Find climbing route information, images, ratings, gradings, and coordinates to get there</p>
								<a href="share-area.php" class="btn">Get Started</a>
							</div>	
						</section>
					</div>
					<div class="wrapper">
						<section class="module">
							<h3><span>Climbs</span></h3>
							<div>
								<p class="cf">Become a member to keep a tick list of all the climbs you have done or want to do</p>
								<a href="share-climb.php" class="btn">Get Started</a>
							</div>
						</section>
					</div>
				</div>
			</div>
<!-- 
Select Area or Climb
Select Type of Climb
Input 
	Area/Climb Name, 
	if(climb){Area name}, 
	Description, 
	Zip Code, 
	Coordinates, 
	Grade, 
	Rating
 -->




	</main>
<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>

	

























