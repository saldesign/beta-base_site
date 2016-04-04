<?php 
	include('userheader.php'); 
	$thisPage="share";
	signedin(1);
	include('header.php'); 

	//parse the form
	if($_POST['did_post']){
	  //extract and sanitize
	  $title = mysqli_real_escape_string($db, $_POST['title']);
	  $description = mysqli_real_escape_string($db, $_POST['description']);
	  $zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);
	  $latitude = mysqli_real_escape_string($db, $_POST['latitude']);
	  $longitude = mysqli_real_escape_string($db, $_POST['longitude']);
	  $is_approved = mysqli_real_escape_string($db, $_POST['is_approved']);

	  //validate
	  $valid = true;
	  //title and description can't be blank
	  if($title == '' OR $description == ''){
	    $valid = false;
	    $errors[]= 'title and description are required';
	  }
	  //checkboxes must be 1 or 0 (not blank)
	  if($is_approved != 1){
	    $is_approved = 0;
	  }
	  //area_id must be int
	  // if(! is_numeric( $area_id)){
	  //   $valid = false;
	  //   $errors[] = 'Please choose a valid area_id';
	  // }

	  // if valid, add to DB
	  if($valid){    
	    $query = "INSERT INTO areas
	              ( title, date, description, zipcode, latitude, longitude, user_id, is_approved)
	              VALUES
	              ('$title', now(), '$description', $zipcode, $latitude, '$longitude', " . USER_ID . ",  $is_approved) ";
	    $result = $db->query($query);
	    if(! $result){
	      echo $db->error;
	    }
	    //make sure 1 row was added, show user feedback
	    if($db->affected_rows == 1){
	      $message = 'Your area was saved';
	      if(! $result){
	      	echo $db->error;
	      }
	    }else{
	      $message = 'Sorry, Your area was not saved';
	    }
	  }//end if valid
	  else{
	    $message = 'Please check for the following errors:';
	  }
	}//end of parser
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
			<div class="container cf">
					<section class="module">
						<h3><span>Share an Area</span></h3>
						<div>
							<p class="icon-share cf">Share climbing areas, detailing how to approach the area, necessary gear and access issues</p>
						</div>
					</section>
			</div>
		</div>

		<section class="module secondary">
		<?php //show feedback if form was submitted
		if($_POST['did_post']){
		  echo '<div class="feedback">';
		  echo $message;
		  //if there are little errors, show them in a list
		  if(! empty($errors)){
		    echo '<ul>';
		      foreach($errors as $item){
		        echo '<li>' . $item . '</li>';
		      }
		    echo '</ul>';
		  }
		  echo '</div>';
		}

		 ?>

			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
				<h4>Area Details</h4>	
				<label>Area Name</label>
					<input type="text" name="title" value="<?php echo stripslashes($title); ?>"></input>

				<label>Area Description</label>
					<p>Please describe the approach, access issues, and any other important details</p>

					<textarea name="description" value="<?php echo stripslashes($description); ?>"></textarea>

				<h4>Area Location</h4>	
				<p>Please enter in the zip code of the area</p>
				<label>Zip Code</label>
					<input type="text" name="zipcode">
				<p>Please enter the coordinates to the parking area</p>
				<p>Use <a href="http://www.latlong.net/">LatLong.net</a> to find a location's coordinates</p>
				<label>Longitude Coordinates</label>
					<input type="text" name="longitude">
				<label>Latitude Coordinates</label>
					<input type="text" name="latitude">

				<label>
				  <input type="checkbox" name="is_approved" value="1" <?php checked( $is_approved, 1) ?>>
				  Make this climb public
				</label>
				<input class="btn" type="submit" value="Save area">
				<input type="hidden" name="did_post" value="1">
			</form>
		</section>
	</main>
</div>
<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>

	

























