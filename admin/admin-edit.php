<?php 
include('../userheader.php');
require('admin-header.php');
include('admin-nav.php');
include('admin-nav.php');
$thisPage="Edit Admin";

// //which post are we editing? the URL looks like admin-edit.php?post_id=x
// $post_id = $_GET['post_id'];

// //parse the form
// if( $_POST['did_post'] ){
//     //extract and sanitize
//     $title          = mysqli_real_escape_string($db, $_POST['title']);
//     $body           = mysqli_real_escape_string($db, $_POST['body']);
//     $is_published   = mysqli_real_escape_string($db, $_POST['is_published']);
//     $allow_comments = mysqli_real_escape_string($db, $_POST['allow_comments']);
//     $category_id    = mysqli_real_escape_string($db, $_POST['category_id']);
    
//     //validate
//     $valid = true;
//     //title & body can't be blank
//     if( $title == '' OR $body == '' ){
//         $valid = false;
//         $errors[] = 'Title and body are required';
//     }
//     //checkboxes must be 1 or 0 (not blank)
//     if($is_published != 1){
//         $is_published = 0;
//     }
//     if($allow_comments != 1){
//         $allow_comments = 0;
//     }
//     //cat must be int
//     if( ! is_numeric( $category_id ) ){
//         $valid = false;
//         $errors[] = 'Please choose a valid category';
//     }
//     //if valid, update the row in the DB
//     if($valid){
//         $query = "UPDATE posts
//                     SET
//                     title           = '$title',
//                     body            = '$body',
//                     is_published    = $is_published,
//                     allow_comments  = $allow_comments,
//                     category_id     = $category_id
//                     WHERE post_id = $post_id
//                     AND user_id = " . USER_ID ;

//         $result = $db->query($query);
//         if(! $result){
//             echo $db->error;
//         }
//         //make sure 1 row was added, then handle user feedback
//         if( $db->affected_rows == 1 ){
//             $message = 'Success! Your post was saved';
//             $status = 'success';
//         }else{
//             $message = 'No changes were made.';
//             $status = 'information';
//         }
//     }//end if valid
//     else{
//         $message = 'Please fix these errors in the form:';
//         $status = 'error';
//     }
    
// }//end of parser


//get all the info about this climb, and make sure the climb was written by the logged in user
$query_climb = "SELECT * 
                FROM climbs 
                WHERE user_id = " . USER_ID . 
                " AND climb_id = $climb_id 
                LIMIT 1";
$result_climb = $db->query($query_climb);

?> 
 ?>

 <main role="main">
     <section class="important panel">

         <?php //kill the page if viewing an invalid climb
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
         $is_approved = $row_climb['is_approved'];
         $title = $row_climb['title'];
         ?>

         <h2>Edit Post</h2>

         <?php //show feedback if the form was submitted
         if( $_POST['did_post'] ){
             echo '<div class="feedback ' . $status . '">';
             echo $message;
             
             //if there are little errors, show them in a list
             if(! empty($errors)){
                 echo '<ul>';
                 foreach( $errors as $item ){
                     echo '<li>' .  $item . '</li>';
                 }
                 echo '</ul>';
             }

             echo '</div>';
         } ?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>?climb_id=<?php echo $climb_id; ?>" method="post">
             <div class="twothirds">
                 <label>Title:</label>
                 <input type="text" name="name" 
                 value="<?php echo stripslashes($name); ?>">

                 <label>Description:</label>
                 <textarea name="description"><?php echo stripslashes($description); ?></textarea>
             </div>
             <div class="onethird">
                 <label>
                     <input type="checkbox" name="is_published" value="1" <?php checked( $is_published, 1 ) ?>>
                     Make this post public
                 </label>

                 <label>
                     <input type="checkbox" name="allow_comments" value="1" <?php checked( $allow_comments, 1 ) ?>>
                     Allow users to comment on this post
                 </label>

                 <?php //get all the categories in alphabetical order 
                 $query = "SELECT * FROM categories
                 ORDER BY name ASC";
                 $result = $db->query($query);
                 if(! $result){
                     echo $db->error;
                 }
                 if($result->num_rows >= 1){
                     ?>
                     <label>Category:</label>
                     <select name="category_id">
                         <?php while( $row = $result->fetch_assoc() ){ ?>

                         <option value="<?php echo $row['category_id']; ?>" <?php selected( $category_id, $row['category_id'] ); ?>>
                             <?php echo $row['name']; ?>
                         </option>

                         <?php }//end while ?>
                     </select>
                     <?php }//end if there are cats ?>

                     <input type="submit" value="Save Post">
                     <input type="hidden" name="did_post" value="1">
                 </div>
             </form>
         </section>
</main>