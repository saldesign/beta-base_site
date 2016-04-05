<article class="form">
<h4>Leave a comment:</h4>
<?php 
//parser feedback
if(isset($message)){
  echo '<div class="message">' . $message . '</div>';
}
 ?>
  <form method="post" action="#image-form" 
      enctype="multipart/form-data">

      <input type="file" name="uploadedfile">

      <input type="submit" value="Upload Image">
      <input type="hidden" name="did_upload" value="1">

  </form>
</article>