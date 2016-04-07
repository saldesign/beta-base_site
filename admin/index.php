<?php 
include('../userheader.php');
require('admin-header.php');
include('admin-nav.php');
$thisPage="Admin Home";
 ?>



<main role="main">
     <section class="module">
         <h2>Manage Your Climbs:</h2>

         <?php //get all the climbs added by the logged in user
         $query = "SELECT climbs.name, climbs.climb_id, climbs.description, climbs.v_grade, climbs.y_grade, climbs.date, areas.area_id, areas.title, climbs.is_approved
               FROM climbs, areas
               WHERE climbs.area_id = areas.area_id
               AND climbs.user_id = " . USER_ID . " 
               ORDER BY climbs.date DESC";
         $result = $db->query($query);
         if(! $result){
             echo $db->error;
         }
         if($result->num_rows >= 1){
         ?>
         <table>
             <tr>
                 <th>Climb</th>
                 <th>Status</th>
                 <th>Date</th>
                 <th>Area</th>
             </tr>
             <?php while( $row = $result->fetch_assoc() ){ ?>
             <tr>
                 <td><a href="admin-edit.php?climb_id=<?php echo $row['climb_id']; ?>"><?php echo $row['name']; ?></a></td>
                 <td><?php echo $row['is_approved'] == 1 ? 'Public' : '<b>Draft</b>';?></td>
                 <td><?php echo nice_date($row['date']); ?></td>
                 <td><?php echo $row['title']; ?></td>
             </tr> 
             <?php } //end while ?>
         </table>
         <?php 
         }//end if rows found 
         else{
             echo 'You haven\'t written any posts yet';
         }?>
     </section>     
     <section class="module">
         <h2>Manage Your Areas:</h2>

         <?php //get all the areas added by the logged in user
         $query = "SELECT areas.area_id, areas.title, users.username, areas.is_approved
               FROM areas, users
               WHERE areas.user_id = users.user_id
               ORDER BY areas.date DESC";
         $result = $db->query($query);
         if(! $result){
             echo $db->error;
         }
         if($result->num_rows >= 1){
         ?>
         <table>
             <tr>
                 <th>Area</th>
                 <th>Status</th>
                 <th>Date</th>
             </tr>
             <?php while( $row = $result->fetch_assoc() ){ ?>
             <tr>
                 <td><a href="admin-edit.php?area_id=<?php echo $row['area_id']; ?>"><?php echo $row['title']; ?></a></td>
                 <td><?php echo $row['is_approved'] == 1 ? 'Public' : '<b>Draft</b>';?></td>
                 <td><?php echo nice_date($row['date']); ?></td>
             </tr> 
             <?php } //end while ?>
         </table>
         <?php 
         }//end if rows found 
         else{
             echo 'You haven\'t written any posts yet';
         }?>
     </section> 
 </main>
<?php include('../footer.php') ?>