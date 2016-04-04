<?php 
include('userheader.php');
$thisPage="signin";

//logout action
if($_GET['action'] == 'logout'){
	//destroy the session, make all cookies null and expired
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);
	unset($_SESSION['secretkey']);
	setcookie('secretkey', '', time() -999999);

	unset($_SESSION['user_id']);
	setcookie('user_id', '', time() -999999);

	header('location:signin.php');

}//end logout action


//begin form parser
if($_POST['did_login']){
	//extract and sanitize
	$username = mysqli_real_escape_string($db, strip_tags($_POST['username']));
	$password = mysqli_real_escape_string($db, strip_tags($_POST['password']));
	//validate
	$valid = true;
	//username must be between 5-50 chars
	if(strlen($username) <= 5 AND strlen($username) >= 50 ){
		$valid = false;
	}
	//password must be at least 8 chars
	if(strlen($password) < 8){
		$valid = false;
	}
	//if valid, look them up in the db, then log them in
	//sha1 is our hash algorithm
	if($valid){
		$query = "SELECT user_id, is_admin
					 FROM users 
					 WHERE username = '$username'
					 AND password = sha1('$password')
					 LIMIT 1";
		$result = $db->query($query);
		if(!result){
			echo $db->error;
		}//end if no result
		//if 1 row is found, success, login for 1 week
		if($result->num_rows == 1){
			//success
			// hash(exact moment in time + random string)
			$secretkey = sha1(microtime() . 'hwhoad5641sfaju51yytththu5659iwdf');
			setcookie('secretkey', $secretkey, time()+60*60*24*7);
			$_SESSION['secretkey'] = $secretkey;

			//get the user id out of the result
			$row = $result->fetch_assoc();
			$user_id = $row['user_id'];
			//store the user_id on their computer
			setcookie('user_id', $user_id, time()+60*60*24*7);
			$_SESSION['user_id'] = $user_id;
			//store the secretkey in the DB
			$query = "UPDATE users 
						SET secret_key = '$secretkey'
						WHERE user_id = $user_id
						LIMIT 1";
			$result = $db->query($query);
			if(!$result){
				die($db->error);
			}else{
				//redirect to admin panel 
				header('Location:index.php');
			}
		}else{
			//error
			$message = 'Your login info is incorrect, try again.';
		}//end num rows result
	}else{
			//invalid
			$message = 'Your login info is incorrect, try again.';
		}//end if valid
}//end parser


//parse the registration form
if($_POST['did_register']){
	// sanitize
	$username = mysqli_real_escape_string($db,strip_tags($_POST['username']));
	$password = mysqli_real_escape_string($db,strip_tags($_POST['password']));
	$email = mysqli_real_escape_string($db,filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
	$policy = filter_var($_POST['policy'], FILTER_SANITIZE_NUMBER_INT);

	// validate
	$valid = true;
	// username is not within 5 - 50 chars
	if(strlen($username) < 5 OR strlen($username) > 50){
		$valid = false;
		$errors['username'] = 'Choose a username that is between 5 - 50 characters long';
	}else{
		// if it passed length check, check for username availability
		$query = "SELECT username 
						FROM users
						WHERE username = '$username'
						LIMIT 1";
		$result = $db->query($query);
		if(!$result){
			echo $db->error;
		}
		if($result->num_rows == 1){
			$valid = false;
			$errors['username'] = 'Sorry, that username is taken. Try another.';
		}
	}// end username tests
	// email is invalid
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$valid = false;
		$errors['email'] = 'Please provide a valid email address, ex: bobber@mail.com';
	}else{
		// email is invalid or blank
		$query = "SELECT email
					FROM users
					WHERE email = '$email'
					LIMIT 1";
		$result = $db->query($query);
		if(!$result){
			echo $db->error;
		}
		if($result->num_rows == 1){
			$valid = false;
			$errors['email'] = 'Your email address is already registered. Do you want to log in?';
		}
	}// end email tests
	// password too short
	if(strlen($password) < 8){
		$valid = false;
		$errors['password'] = 'Your password must be atleast 8 characters.';
	}
	// policy unchecked
	if($policy != 1){
		$valid = false;
		$errors['policy'] = 'You must agree to the terms of service';
	}
	// if valid, log them in and store user info in DB
	if($valid){
		//generate the secret key
		$secretkey = sha1(microtime() . 'a;dfgorighlkngoiuerohreho4938497856890jertyo');
		$query = "INSERT INTO users
						(username, password, email, secret_key)
						VALUES 
						('$username', sha1('$password'),'$email', '$secretkey')";
		$result = $db->query($query);
		//check to make sure 1 row was added
		if($db->affected_rows == 1){
			// success!
			//log them in automatically
			//get their user id
			$user_id = $db->insert_id;
			setcookie('user_id', $user_id, time()+60*60*24*7);
			$_SESSION['user_id'] = $user_id;

			setcookie('secretkey', $secretkey, time()+60*60*24*7);
			$_SESSION['secretkey'] = $secretkey;
			header('Location:admin/');
		}else{
			$message = 'Something went wrong during account creation, Sorry';
		}
	}// end if valid
}// end registration parser

include('header.php');

?>
	<div class="maincontainer"> 
		<main class="<?php if($thisPage == "signin"){
						echo "signin";
						} ?>">

			<div class="wrapper">
				<section class="module">
					<h2 class="headlined"><span>Sign in</span></h2>
					<?php
						if(isset($message)){
							echo $message;
						}
					?>
					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
						<label>Username:</label>
						<input type="text" name="username">

						<label>Password:</label>	
						<input type="password" name="password">
						<input class="btn" type="submit" value="Log In">
						<input type="hidden" name="did_login" value="1">
					</form>
				</section>
			</div>
			
			<div class="wrapper">
				<section class="module">
					 <h2 class="headlined"><span>Sign Up</span></h2>
					 <?php //show user feedback
					 if($_POST['did_register']){
					 	echo '<div class="feedback">';
					 	if(isset($message)){
					 		echo $message;
					 	}
					 	//show errors as a list
					 	if(!empty($errors)){
					 		echo '<ul>';
					 		foreach($errors as $error){
					 			echo '<li>' . $error .'</li>';
					 		}
					 		echo '</ul>';
					 	}
					 	echo '</div>';
					 }
					  ?>
					  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					  		<label <?php field_error($errors['username']) ?>>Create a Username</label>
					  			<input type="text" name="username" placeholder="Between 5 - 50 Characters" value="<?php echo $username ?>">
					  		<label>Your Email Address</label>
					  			<input type="email" name="email" placeholder="you@email.com" value="<?php echo $email ?>" <?php field_error($errors['email']) ?>>
					  		<label>Choose a password</label>
					  			<input type="password" name="password" placeholder="At least 8 Characters" value="<?php echo $password ?>" <?php field_error($errors['password']) ?>>

					  		<label <?php field_error($errors['policy']) ?>>
					  			<input type="checkbox" name="policy" value="1"  <?php echo $policy == 1 ? 'checked' : ''; ?>>
					  			I agree to the <a href="#">terms of service</a> and privacy policy
					  		</label>
					  		<input class="btn" type="submit" value="Submit">
					  		<input type="hidden" name="did_register" value="1">
					  </form>
				</section>
			</div>
		</main>
	</div>
<?php include('footer.php'); ?>
</body>
</html>