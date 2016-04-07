<?php 
include('../userheader.php');
require('admin-header.php');
include('admin-nav.php');
$thisPage="Edit Admin";

//which climb are we editing? the URL looks like admin-edit.php?climb_id=x
$climb_id = $_GET['climb_id'];

//parse the climb form
if($_POST['did_post'] ){

//extract and sanitize
    $name         =  mysqli_real_escape_string($db, $_POST['name']);
    $description  =  mysqli_real_escape_string($db, $_POST['description']);
    // $type         =  mysqli_real_escape_string($db, $_POST['type']);
    $v_grade      =  mysqli_real_escape_string($db, $_POST['v_grade']);
    $y_grade      =  mysqli_real_escape_string($db, $_POST['y_grade']);
    $is_approved  =  mysqli_real_escape_string($db, $_POST['is_approved']);
    $title        =  mysqli_real_escape_string($db, $_POST['title']);

//validate
    $valid = true;

    //name and description can't be blank
    if( $name == '' OR $description == '' ){
        $valid = false;
        $errors[] = 'Name and Description are required';
    }

    //checkboxes must be 1 or 0 (not blank)
    if($is_approved != 1){
        $is_approved = 0;
    }
    // if($type != 1){
    //     $valid = false;
    // }

    //v_grade and y_grade cannot both be null


//if valid, update row in DB
    if($valid){
        $query = "UPDATE climbs 
                    SET
                    name         =  $name ,
                    description  =  $description ,
                    type         =  $type ,
                    v_grade      =  $v_grade ,
                    y_grade      =  $y_grade ,
                    is_approved  =  $is_approved ,
                    area_id      =  $area_id 
                  WHERE climb_id =  $climb_id
                    AND user_id = " . USER_ID;
        $result = $db->query($query);
        if(! $result){
            echo $db->error;
        }
        //make sure 1 row was added, then handle user feedback
        if( $db->affected_rows == 1 ){
            $message = 'Success! Your post was saved';
            $status = 'success';
        }else{
            $message = 'No changes were made.';
            $status = 'information';
        }
    }//end if valid
    else{
        $message = 'Please fix these errors in the form:';
        $status = 'error';
    }

}//end parser


//get all the info about this climb, and make sure the climb was written by the logged in user
$query_climb = "SELECT climbs.name, climbs.description, climbs.type, climbs.v_grade, climbs.y_grade, climbs.is_approved, areas.title, climbs.area_id
                FROM climbs, areas
                WHERE climbs.user_id = " . USER_ID . " 
                AND climb_id = $climb_id 
                AND climbs.area_id = areas.area_id
                LIMIT 1";
$result_climb = $db->query($query_climb);
?> 


<main role="main">
    <section class="important panel box">
        <?php 
        //kill the page if viewing an invalid climb
        if( ! $result_climb ){
            echo $db->error;
        } 
        if( $result_climb->num_rows != 1 ){
            die('You do not have permission to edit that climb.');
        } 

        //get the info from the DB result
        $row_climb = $result_climb->fetch_assoc();

        $name = $row_climb['name'];
        $description = $row_climb['description'];
        $type = explode(',', $row_climb['type']);
        $v_grade = $row_climb['v_grade'];
        $y_grade = $row_climb['y_grade'];
        $is_approved = $row_climb['is_approved'];
        $title = $row_climb['title'];
        
         //show feedback if form was submitted
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
         } ?>
         <h2>Edit Climb</h2>


         <form action="<?php $_SERVER['PHP_SELF']; ?>?climb_id=<?php echo $climb_id; ?>" method="post">
            <h4>Climb Details</h4>  
            <label>Climb Name</label>
                <input type="text" name="name" value="<?php echo stripslashes($name); ?>"></input>
            <?php 
            // get all the areas in alphabetical order
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
                         <?php selected($row['area_id'], $row_climb['area_id']); ?>>
                        <?php echo $row['title']; ?>
                  </option>
                  <?php }// end while ?>
                </select>
            <?php }// end if areas ?>

            <label>Climb Description</label>
                <textarea name="description"><?php echo stripslashes($description); ?></textarea>
            <legend>Type of Climb:
                    <label for="boulder">Boulder
                        <input type="checkbox" name="type[]" id="boulder" value="Boulder" <?php checked_array($type, 'Boulder' ); ?>>
                    </label>
                    <label for="top-rope">Top Rope
                        <input type="checkbox" name="type[]" id="top-rope" value="Top Rope" <?php checked_array($type, 'Top Rope' ); ?>>
                    </label>
                    <label for="sport">Sport
                        <input type="checkbox" name="type[]" id="sport" value="Sport" <?php checked_array($type, 'Sport' ); ?>>
                    </label>
                    <label for="trad">Trad
                        <input type="checkbox" name="type[]" id="trad" value="Trad" <?php checked_array($type, 'Trad' ); ?>>
                    </label>
            </legend>

            <h3>Grading &amp; Rating</h3>
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
                  <p> <input type="checkbox" name="is_approved" value="1" <?php checked( $is_approved, 1) ?>>Make this climb public</p>
                </label>
                <input class="btn" type="submit" value="Save Climb">
                <input type="hidden" name="did_post" value="1">
            </form>




    </section>
</main>