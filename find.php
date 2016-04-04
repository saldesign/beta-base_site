<?php 
include('userheader.php');
$thisPage="find"; 
include('header.php'); ?>

<div class="maincontainer">
	<main>
		<section class="module banner">
			<h2><span>find climbs and areas</span><span><a href="#">SIGN UP</a> to add your ratings and comments</span><span><a href="#">SHARE</a> to post your own climbs</span></h2>
		</section>

		<div class="quicklinks cf">
			<div class="container">
				<section class="module">
						<h3><span>Find</span></h3>
						<div>
							<p class="icon-join cf">Follow the steps below to find climbs in the area you are looking</p>
						</div>
				</section>
			</div>
		</div>
		<form action="search-result.php" method="get">
			<section class="module secondary">
				<h4>location</h4>
				<label>Zip Code
					<input type="text" name="zipcode" placeholder="92119">
				</label>
				<input type="submit" value="Search Area">
				<input type="hidden" name="did_submit" value="1">
			</section>
		</form>
	</main>
<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>

	

























