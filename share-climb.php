<?php 
	include('userheader.php'); 
	$thisPage="share";
	signedin(1);
	include('header.php'); 

	//parse the form
	if($_POST['did_post']){
	  //extract and sanitize
	  $name = mysqli_real_escape_string($db, $_POST['name']);
	  $description = mysqli_real_escape_string($db, $_POST['description']);
	  $is_approved = mysqli_real_escape_string($db, $_POST['is_approved']);
	  $area_id = mysqli_real_escape_string($db, $_POST['area_id']);
	  $v_grade = mysqli_real_escape_string($db, $_POST['v_grade']);
	  $y_grade = mysqli_real_escape_string($db, $_POST['y_grade']);
	  $type = mysqli_real_escape_string($db, implode(',',$_POST['type']) );
	  $rating = mysqli_real_escape_string($db, $_POST['rating']);
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
	    $query = "INSERT INTO climbs
	              ( name, date, description, v_grade, y_grade, type, user_id, area_id, is_approved)
	              VALUES
	              ('$name', now(), '$description', '$v_grade', '$y_grade', '$type', " . USER_ID . ", $area_id, $is_approved) ";
	    $result = $db->query($query);
	    if(! $result){
	      echo $db->error;
	    }
	    //make sure 1 row was added, show user feedback
	    if($db->affected_rows == 1){
	      $message = 'Your climb was saved';

	      //insert rating into ratings table
	      $climb_id = $db->insert_id;
	      $query = "INSERT INTO ratings 
	      				( climb_id, rating, user_id )
	      			 VALUES 
	      			 	(  $climb_id, $rating, " . USER_ID . " )";
	      $result = $db->query($query);

	      if(! $result){
	      	echo $db->error;
	      }
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
				  <option 
				  		value="<?php echo stripslashes($row['area_id']); ?>" 
						<?php selected($area_id, $row['area_id']); ?>>
						<?php echo $row['title']; ?>
				  </option>
				  <?php }// end while ?>
				</select>
			<?php }// end if areas ?>

			<label>Climb Description</label>
				<textarea name="description" value="<?php echo stripslashes($description); ?>"></textarea>
			<legend>Type of Climb:
					<label for="boulder">Boulder
						<input type="checkbox" name="type[]" id="boulder" value="Boulder">
					</label>
					<label for="top-rope">Top Rope
						<input type="checkbox" name="type[]" id="top-rope" value="Top Rope">
					</label>
					<label for="sport">Sport
						<input type="checkbox" name="type[]" id="sport" value="Sport">
					</label>
					<label for="trad">Trad
						<input type="checkbox" name="type[]" id="trad" value="Trad">
					</label>
			</legend>

			<h4>Grading &amp; Rating</h4>
			<label>Difficulty: V-Scale</label>
				<select name="v_grade">
					<option value="NULL">Not Applicable</option>
					<option value="V0">V0</option>
					<option value="V1">V1</option>
					<option value="V2">V2</option>
					<option value="V3">V3</option>
					<option value="V4">V4</option>
					<option value="V5">V5</option>
					<option value="V6">V6</option>
					<option value="V7">V7</option>
					<option value="V8">V8</option>
					<option value="V9">V9</option>
					<option value="V10">V10</option>
					<option value="V11">V11</option>
					<option value="V12">V12</option>
					<option value="V13">V13</option>
					<option value="V14">V14</option>
				</select>

				<label>Difficulty: Yosemite Decimal Scale</label>
					<select name="y_grade">
						<option value="NULL">Not Applicable</option>
						<option value="5.5">5.5</option>
						<option value="5.6">5.6</option>
						<option value="5.7">5.7</option>
						<option value="5.8">5.8</option>
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

				<label>Rate this climb: 1 - 5 Stars</label>
					<select name="rating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				<label>
				  <input type="checkbox" name="is_approved" value="1" <?php checked( $is_approved, 1) ?>>
				  <p>Make this climb public</p>
				</label>
				<input class="btn" type="submit" value="Save Climb">
				<input type="hidden" name="did_post" value="1">
			</form>
		</section>
	</main>
</div>
<?php include('aside.php'); ?>
</div>
<?php include('footer.php'); ?>

	

























