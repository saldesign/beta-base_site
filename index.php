<?php 
include('userheader.php');
signedin();
$thisPage="home";
include('header.php');
 ?>

<div class="maincontainer">

	<main>
		<section class="module banner">
			<h2><span>Where climbers come</span><span> to <a href="share.php">share</a> and <a href="find.php">find</a></span><span> rock climbing beta</span></h2>
		</section>

		<div class="quicklinks cf">
			<div class="container cf">
				<div class="wrapper">
					<section class="module">
						<h3><span>Share</span></h3>
						<div>
							<p class="icon-share cf">Share developed climbing routes along with descriptions, gradings, ratings, coordinates and images</p>
							<a href="share.php" class="btn">Get Started</a>
						</div>
					</section>
				</div>
				<div class="wrapper">
					<section class="module">
						<h3><span>Find</span></h3>
						<div> 
							<p class="icon-find cf">Find climbing route information, images, ratings, gradings, and coordinates to get there</p>
							<a href="find.php" class="btn">Get Started</a>
						</div>	
					</section>
				</div>
			</div>
<?php if(defined('IS_LOGGED_IN')==false){ ?>
			<div class="container">
				<section class="module">
						<h3><span>Join</span></h3>
						<div>
							<p class="icon-join cf">Become a member to keep a tick list of all the climbs you have done or want to do</p>
							<a href="signin.php" class="btn">Get Started</a>
						</div>
				</section>
<?php } ?>
			</div>
		</div>
	</main>

	<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>

	

























