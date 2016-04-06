<?php 
if($_POST['did_upload']){
    //where to store images
  	$upload_path = ROOT_PATH . '/uploads';

		//Image sizes
		$sizes = array(
			'thumb' => 150,
			'medium' => 300,
			);
		$uploadedfile = $_FILES['uploadedfile']['tmp_name'];

	  //validate images
		list($width, $height) = getimagesize($uploadedfile);
	  //if the width and height are 0 = not an image
		if($width > 0 AND $height > 0){
		  	//what type of image
			$filetype = $_FILES['uploadedfile']['type'];

			switch($filetype){
				case 'image/gif':
				$source = imagecreatefromgif($uploadedfile);
				break;
				case 'image/jpg':
				case 'image/jpeg':
				case 'image/pjpeg':
				$source = imagecreatefromjpeg($uploadedfile);
				break;

				case 'img/png':
				ini_set( 'memory_limit', '16M' );
				$source = imagecreatefrompng($uploadedfile);
				ini_restore('memory_limit');
				break;

				default:
				$image_message = 'The only allowed filetypes are png, gif and jpg';
				$status = 'error';
  			}//end of filetype switch

  			//resize and save the images (loop)
  			$uniquestring = sha1(microtime());
  			foreach( $sizes AS $size_name => $size_width ){
  			    //if the original image is smaller than the target size, keep it at the original size
  				if( $width < $size_width ){
  					$new_width = $width;
  					$new_height = $height;
  				}else{
  			        //large image - calculate new width and height
  					$new_width = $size_width;
  					$new_height = ($height/$width) * $new_width;
  				}

  				$tmp_canvas = imagecreatetruecolor($new_width, $new_height);
  				imagecopyresampled($tmp_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

  				$filename = $upload_path . '/' . $uniquestring . '_' . $size_name . 
  				'.jpg';
  				$did_save = imagejpeg($tmp_canvas, $filename, 70);
  			}//end foreach

  			if($did_save){
  				//Add image data to image table
          if(isset($_GET['area_id']) ){
    				$query = "INSERT INTO images 
                        (image, user_id, area_id, is_approved)
    							    VALUES
                        ('$uniquestring',". constant("USER_ID") .",$area_id, 1)";
          }else{
            $query = "INSERT INTO images 
                        (image, user_id, climb_id, is_approved)
                      VALUES
                        ('$uniquestring',". constant("USER_ID") .",$climb_id, 1)";            
          }
  				$result = $db->query($query);
  				if(! $result){
  					$image_message = $db->error;
  					$status = 'error';
  				}
  				if($db->affected_rows == 1){
  				    $image_message = 'Success! Your Area Image has been updated';
  				    $status = 'success';
  				}else{
  				    $image_message = 'Sorry, your Area Image could not be changed';
  				    $status = 'error';
  				}
  			}//end if did save
  			else{
  			    $image_message = 'Sorry, your image could not be saved. Try again.';
  			    $status = 'error';
  			}
	  }//end validate image

}//end parser
?>