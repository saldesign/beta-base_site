<?php 
	require('db-config.php'); //require will kill the page if it doesn't load successfully 
	$thisPage="share";
	include('header.php'); 
	include_once('functions.php');

	//parse the form
	if($_POST['did_post']){
	  //extract and sanitize
	  $name = mysqli_real_escape_string($db, $_POST['name']);
	  $description = mysqli_real_escape_string($db, $_POST['description']);
	  $is_approved = mysqli_real_escape_string($db, $_POST['is_approved']);
	  $area_id = mysqli_real_escape_string($db, $_POST['area_id']);
	  $area_id = mysqli_real_escape_string($db, $_POST['area_id']);
	  //validate
	  $valid = true;
	  //title and description can't be blank
	  if($name == '' OR $description == ''){
	    $valid = false;
	    $errors[]= 'Name and description are required';
	  }
	  //checkboxes must be 1 or 0 (not blank)
	  if($is_approved != 1){
	    $is_approved = 0;
	  }
	  //category must be int
	  if(! is_numeric( $area_id)){
	    $valid = false;
	    $errors[] = 'Please choose a valid category';
	  }
	  //if valid, add to DB
	  if($valid){    
	    $query = "INSERT INTO climbs
	              ( name, date, description, user_id, area_id, is_approved)
	              VALUES
	              ('$title', now(), '$description', " . USER_ID . ", $area_id, $is_approved) ";
	    $result = $db->query($query);
	    if(! $result){
	      echo $db->error;
	    }
	    //make sure 1 row was added, show user feedback
	    if($db->affected_rows == 1){
	      $message = 'Your climb was saved';
	    }else{
	      $message = 'Sorry, Your climb was not saved';
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
						<h3><span>Share a Climb</span></h3>
						<div>
							<p class="icon-share cf">Share climbing routes or climbing areas along with descriptions, gradings, ratings, coordinates and images</p>
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
			<h4>Climb Details</h4>	
			<label>Climb Name</label>
				<input type="text" name="name" value="<?php echo stripslashes($name); ?>"></input>
			<?php // get all the areas in alphabetical order
			$query ="SELECT * FROM areas 
			ORDER BY title ASC";
			$result = $db->query($query);
			if(! $result){
			  echo $db->error;
			}
			if($result->num_rows >= 1){ ?>
			<label>Which area does this climb belong to?</label>
				<select name="area_id">
				  <?php while($row = $result->fetch_assoc() ){ ?>
				  <option value="<?php echo $row['area_id']; ?>" <?php 
				  selected($area_id, $row['area_id']); ?>>
				  <?php echo $row['title']; ?>
				  </option>
				  <?php }// end while ?>
				</select>
			<?php }// end if areas ?>

			<label>Climb Description</label>
				<input type="text" name="description" value="<?php echo stripslashes($description); ?>"></input>
			<h5>Latitude &amp; Longitude</h5>
			<p><a href="http://www.latlong.net/" title="latitude longitude finder">latitude longitude finder</a><p>
			<label>Longitude Coordinate</label>
			<input type="text" name="longitude" value="<?php echo stripslashes($longitude); ?>">
			<label>Latitude Coordinate</label>
			<input type="text" name="latitude" value="<?php echo stripslashes($latitude); ?>">

			<h5>Grading &amp; Rating</h5>
			<p>* Choose either Difficulty Grade: V-Sale or Yosemite Decimal Scale</p>
			<label>Difficulty: V-Scale</label>
				<select name="v_scale">
					<option value="na">Not Applicable</option>
					<option value="0">V0</option>
					<option value="1">V1</option>
					<option value="2">V2</option>
					<option value="3">V3</option>
					<option value="4">V4</option>
					<option value="5">V5</option>
					<option value="6">V6</option>
					<option value="7">V7</option>
					<option value="8">V8</option>
					<option value="9">V9</option>
					<option value="10">V10</option>
					<option value="11">V11</option>
					<option value="12">V12</option>
					<option value="13">V13</option>
					<option value="14">V14</option>
				</select>
				<label>Difficulty: Yosemite Decimal Scale</label>
					<select name="v_scale">
						<option value="na">Not Applicable</option>
						<option value="5.5">5.5</option>
						<option value="5.6">5.6</option>
						<option value="5.6">5.7</option>
						<option value="5.7">5.8</option>
						<option value="5.9">5.9</option>
						<option value="5.10">5.10</option>
						<option value="5.10a">5.10a</option>
						<option value="5.10b">5.10b</option>
						<option value="5.10c">5.10c</option>
						<option value="5.10d">5.10d</option>
						<option value="5.11">5.11</option>
						<option value="5.11a">5.11a</option>
						<option value="5.11b">5.11b</option>
						<option value="5.11c">5.11c</option>
						<option value="5.11d">5.11d</option>
						<option value="5.12">5.12</option>
						<option value="5.12a">5.12a</option>
						<option value="5.12b">5.12b</option>
						<option value="5.12c">5.12c</option>
						<option value="5.12d">5.12d</option>
						<option value="5.13">5.13</option>
						<option value="5.13a">5.13a</option>
						<option value="5.13b">5.13b</option>
						<option value="5.13c">5.13c</option>
						<option value="5.13d">5.13d</option>
						<option value="5.14">5.14</option>
						<option value="5.14a">5.14a</option>
						<option value="5.14b">5.14b</option>
						<option value="5.14c">5.14c</option>
						<option value="5.14d">5.14d</option>
					</select>
				<label>
				  <input type="checkbox" name="is_approved" value="1" <?php checked( $is_approved, 1) ?>>
				  Make this climb public
				</label>
				<input class="btn" type="submit" value="Save Climb">
				<input type="hidden" name="did_post" value="1">
			</form>
		</section>
	</main>
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




<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>

	

























