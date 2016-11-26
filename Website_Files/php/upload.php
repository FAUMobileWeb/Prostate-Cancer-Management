<?php
//Image Resize code by Nimrod007
//https://github.com/Nimrod007/PHP_image_resize
function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
  							  $quality = 100
  		 ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;
 
    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
 
    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );
 
      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }
 
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);
 
      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }
 
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }
 
    return true;
  }

    session_start();

    if ($_SESSION['userid'] && $_POST['title']) {
        require_once('php_connect.php');

        $formOk = true;
        $title = $_POST['title'];
        $weight = $_POST['weight'];
        
        if (empty($title) || empty($weight)) {
            header("location: message.php?msg=Fill out all the fields!");
        }
        
        if ($_FILES['fileInput']['name'][0] == '') {
            $size = 0;
        } else {
            $size = count($_FILES['fileInput']['name']);
        }
        
        $sql = "INSERT INTO data (user_id, title, weight) VALUES (".$_SESSION['userid'].", '$title', $weight)";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        $sql = "SELECT max(id) FROM data";
        $query = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($query);
        $data_id = $row[0];
        
        $usedNames = [];
        $sql = "SELECT name FROM images WHERE user_id=".$_SESSION['userid'];
        $query = mysqli_query($db, $sql) or die(mysqli_error($db));
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                array_push($usedNames, $row['name']);
            }
        }
    
        $uploadedIds = [];
        for ($i = 0; $i < $size; $i++) {
            if (!in_array($_FILES['fileInput']['type'][$i], array('image/png', 'image/jpeg', 'image/jpe', 'image/gif', 'image/jpg'))) {
                $formOk = false;
                $msg = "Error: Unsupported file extension. Supported extensions are JPG / PNG / GIF.";
                break;
            }
            
            if ($_FILES['fileInput']['size'][$i] > 10000000) {
                $formOk = false;
                $msg = "Error: Unsupported file size. Max file size is 10MB.";
                break;
            }
            
            if (in_array($_FILES['fileInput']['name'][$i], $usedNames)) {
                $formOk = false;
                $msg = "Error: File name already exists. (".$_FILES['fileInput']['name'][$i].")";
                break;
            }
        
            echo smart_resize_image($_FILES['fileInput']['tmp_name'][$i], 
                                   file_get_contents($_FILES['fileInput']['tmp_name'][$i]),
                                    500, 500, false, $_FILES['fileInput']['tmp_name'][$i],
                                   true, false, 45);

            $image = file_get_contents($_FILES['fileInput']['tmp_name'][$i]);
            $imageName = $_FILES['fileInput']['name'][$i];
            $image = mysqli_real_escape_string($db, $image);
                        
            $sql = "INSERT INTO images (user_id, data_id, name, image) VALUES (".$_SESSION['userid'].", $data_id, '{$imageName}','{$image}')";
            if (mysqli_query($db, $sql)) {
                $sql = "SELECT max(id) FROM images";
                $query = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($query);
                array_push($uploadedIds, $row[0]);
            }
        }
        
        if (!$formOk) {
            $n = count($uploadedIds);
            for ($i = 0; $i < $n; $i++) {
                $sql = "DELETE FROM images WHERE id=$uploadedIds[$i]";
                mysqli_query($db, $sql) or die(mysqli_error($db));
            }
            
            $sql = "DELETE FROM data WHERE id=$data_id";
            mysqli_query($db, $sql) or die(mysqli_error($db));
            
            header("location: message.php?msg=$msg");
        } else {
            header("location: dashboard.php");
        }
    }
?>