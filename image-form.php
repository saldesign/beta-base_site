<article class="form">
<h4>Post an Image:</h4>
<?php 
//parser feedback
if(isset($image_message)){
  echo '<div class="message">' . $image_message . '</div>';
}
 ?>
  <form method="post" action="#image-form" 
      enctype="multipart/form-data">

      <input type="file" name="uploadedfile">

      <input type="submit" value="Upload Image">
      <input type="hidden" name="did_upload" value="1">

  </form>
</article>