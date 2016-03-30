<?php 
	$thisPage="share";
	include('header.php'); 
?>

<div class="maincontainer">
	<main>
		<section class="module banner">
			<h2><span>find climbs and areas</span><span><a href="#">SIGN UP</a> to add your ratings and comments</span><span><a href="#">SHARE</a> to post your own climbs</span></h2>
		</section>

			<div class="quicklinks cf">
				<div class="container cf">
						<section class="module">
							<h3><span>Share</span></h3>
							<div>
								<p class="icon-share cf">Share climbing routes or climbing areas along with descriptions, gradings, ratings, coordinates and images</p>
							</div>
						</section>
				</div>

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

	

























