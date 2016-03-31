	<footer>
		<div class="maincontainer">
			<div class="logo cf">
				<h2><a href="#"><span>Beta-Base Rock Climbing Guide</span></a></h2>
				<span class="btncontainer">
					<a class="btn" href="<?php 
						if( array_key_exists( 'secretkey', $_COOKIE ) 
							AND array_key_exists( 'user_id', $_COOKIE ) ){
							$_SESSION['secretkey'] = $_COOKIE['secretkey'];
							$_SESSION['user_id'] = $_COOKIE['user_id'];
							echo "admin/index.php";
						}else{
							echo "signin.php";
						}
					 ?>" class="<?php 
					if($thisPage == "signin"){
						echo "currentpage";
						} 
						?>"><?php 
						if( array_key_exists( 'secretkey', $_COOKIE ) 
							AND array_key_exists( 'user_id', $_COOKIE ) ){
							echo "My Account";
						}else{
							echo "Sign In";
						}
					 ?></a>
				</span>
			</div>
			<div class="contact">
				<h4>CONTACT US</h4>
				<a href="mailto:someone@example.com?Subject=Hello%20again" target="_top" class="icon-mail">beta-base@beta-base.com</a>
			</div>
	<!-- 		<label class="newsletter">JOIN THE NEWSLETTER:
				<input type="email" name="email">Email</input><button>Sign Up</button>
			</label> -->
			<div class="sitemap">
				<h4>SITEMAP</h4>
				<nav>
					<ul class="cf">
						<li><a href="index.php" class="<?php if($thisPage == "home"){
							echo "currentpage";
							} ?>">HOME</a></li>
						<li><a href="about.php" class="<?php if($thisPage == "about"){
							echo "currentpage";
							} ?>">ABOUT</a></li>
						<li><a href="share.php" class="<?php if($thisPage == "share"){
							echo "currentpage";
							} ?>">SHARE</a></li>
						<li><a href="find.php" class="<?php if($thisPage == "find"){
							echo "currentpage";
							} ?>">FIND</a></li>
					</ul>
				</nav>
			</div>
			<nav class="social-nav">
				<h4>CONNECT</h4>
				<ul class="cf">
					<li><a href="#"class="icon-f"></a></li>
					<li><a href="#"class="icon-i"></a></li>
					<li><a href="#"class="icon-g"></a></li>
					<li><a href="#"class="icon-t"></a></li>
				</ul>
			</nav>
			</div>
			<a href="terms.php" class="terms <?php if($thisPage == "terms"){
					echo "currentpage";
					} ?>">Terms and Conditions</a>
	</footer>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="css/script.js"></script>
</body>
</html>