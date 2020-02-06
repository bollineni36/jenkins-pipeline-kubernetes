<?php
/**
 * File: SimpleImage.php
 * Author: Simon Jarvis
 * Modified by: Miguel Fermín
 * Based in: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
 * 
 * This program is free software; you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation; either version 2 
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
 * GNU General Public License for more details: 
 * http://www.gnu.org/licenses/gpl.html
 */
 
class SimpleImage {
   
	var $image;
	var $image_type;
 
	function __construct($filename = null){
		if (!empty($filename)) {
			$this->load($filename);
		}
	}
 
	function load($filename)
	{
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
 
		if ($this->image_type == IMAGETYPE_JPEG) {
			$this->image = imagecreatefromjpeg($filename);
		} elseif ($this->image_type == IMAGETYPE_GIF) {
			$this->image = imagecreatefromgif($filename);
		} elseif ($this->image_type == IMAGETYPE_PNG) {
			$this->image = imagecreatefrompng($filename);
		} else {
			throw new Exception("The file you're trying to open is not supported");
		}
	}
 
	function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null)
	{
		if ($image_type == IMAGETYPE_JPEG) {
			imagejpeg($this->image,$filename,$compression);
		} elseif ($image_type == IMAGETYPE_GIF) {
			imagegif($this->image,$filename);         
		} elseif ($image_type == IMAGETYPE_PNG) {
			imagepng($this->image,$filename);
		}
 
		if ($permissions != null) {
			chmod($filename,$permissions);
		}
	}
 
	function output($image_type=IMAGETYPE_JPEG, $quality = 80)
	{
		if ($image_type == IMAGETYPE_JPEG) {
			header("Content-type: image/jpeg");
			imagejpeg($this->image, null, $quality);
		} elseif ($image_type == IMAGETYPE_GIF) {
			header("Content-type: image/gif");
			imagegif($this->image);         
		} elseif ($image_type == IMAGETYPE_PNG) {
			header("Content-type: image/png");
			imagepng($this->image);
		}
	}
 
	function getWidth()
	{
		return imagesx($this->image);
	}
 
	function getHeight()
	{
		return imagesy($this->image);
	}
 
	function resizeToHeight($height)
	{
		$ratio = $height / $this->getHeight();
		$width = round($this->getWidth() * $ratio);
		$this->resize($width,$height);
	}
 
	function resizeToWidth($width)
	{
		$ratio = $width / $this->getWidth();
		$height = round($this->getHeight() * $ratio);
		$this->resize($width,$height);
	}
 
	function square($size)
	{
		$new_image = imagecreatetruecolor($size, $size);
 
		if ($this->getWidth() > $this->getHeight()) {
			$this->resizeToHeight($size);
			
			imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
			imagealphablending($new_image, false);
			imagesavealpha($new_image, true);
			imagecopy($new_image, $this->image, 0, 0, ($this->getWidth() - $size) / 2, 0, $size, $size);
 
		} else {
			$this->resizeToWidth($size);
			
			imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
			imagealphablending($new_image, false);
			imagesavealpha($new_image, true);
			imagecopy($new_image, $this->image, 0, 0, 0, ($this->getHeight() - $size) / 2, $size, $size);
 
		}
 
		$this->image = $new_image;
	}
   
	function scale($scale)
	{
		$width = $this->getWidth() * $scale/100;
		$height = $this->getHeight() * $scale/100; 
		$this->resize($width,$height);
	}
   
	function resize($width,$height)
	{
		$new_image = imagecreatetruecolor($width, $height);
		
		imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
		imagealphablending($new_image, false);
		imagesavealpha($new_image, true);
		
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;   
	}
 
    function cut($x, $y, $width, $height)
    {
    	$new_image = imagecreatetruecolor($width, $height);	
 
		imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
		imagealphablending($new_image, false);
		imagesavealpha($new_image, true);
 
		imagecopy($new_image, $this->image, 0, 0, $x, $y, $width, $height);
 
		$this->image = $new_image;
	}
 
	function maxarea($width, $height = null)
	{
		$height = $height ? $height : $width;
		
		if ($this->getWidth() > $width) {
			$this->resizeToWidth($width);
		}
		if ($this->getHeight() > $height) {
			$this->resizeToheight($height);
		}
	}
 
	function cutFromCenter($width, $height)
	{
		
		if ($width < $this->getWidth() && $width > $height) {
			$this->resizeToWidth($width);
		}
		if ($height < $this->getHeight() && $width < $height) {
			$this->resizeToHeight($height);
		}
		
		$x = ($this->getWidth() / 2) - ($width / 2);
		$y = ($this->getHeight() / 2) - ($height / 2);
		
		return $this->cut($x, $y, $width, $height);
	}
 
	function maxareafill($width, $height, $red = 0, $green = 0, $blue = 0)
	{
	    $this->maxarea($width, $height);
	    $new_image = imagecreatetruecolor($width, $height); 
	    $color_fill = imagecolorallocate($new_image, $red, $green, $blue);
	    imagefill($new_image, 0, 0, $color_fill);        
	    imagecopyresampled(	$new_image, 
	    					$this->image, 
	    					floor(($width - $this->getWidth())/2), 
	    					floor(($height-$this->getHeight())/2), 
	    					0, 0, 
	    					$this->getWidth(), 
	    					$this->getHeight(), 
	    					$this->getWidth(), 
	    					$this->getHeight()
	    				); 
	    $this->image = $new_image;
	}
 
}
 /*
// Usage:
// Load the original image
$image = new SimpleImage('lemon.jpg');
 
// Resize the image to 600px width and the proportional height
$image->resizeToWidth(600);
$image->save('lemon_resized.jpg');
 
// Create a squared version of the image
$image->square(200);
$image->save('lemon_squared.jpg');
 
// Scales the image to 75%
$image->scale(75);
$image->save('lemon_scaled.jpg');
 
// Resize the image to specific width and height
$image->resize(80,60);
$image->save('lemon_resized2.jpg');
 
// Resize the canvas and fill the empty space with a color of your choice
$image->maxareafill(600,400, 32, 39, 240);
$image->save('lemon_filled.jpg');
 
// Output the image to the browser:
$image->output();
*/
function smart_resize_image($file,
                              $width = 0,
                              $height = 0,
                              $proportional = false,
                              $output = 'file',
                              $delete_original = true,
                              $use_linux_commands = false,
   $quality = 100
   ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;

    # Setting defaults and meta
    $info = getimagesize($file);
    $image = '';
    $final_width = 0;
    $final_height = 0;
    list($width_old, $height_old) = $info;
$cropHeight = $cropWidth = 0;

    # Calculating proportionality
    if ($proportional) {
      if ($width == 0) $factor = $height/$height_old;
      elseif ($height == 0) $factor = $width/$width_old;
      else $factor = min( $width / $width_old, $height / $height_old );

      $final_width = round( $width_old * $factor );
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
      case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file); break;
      case IMAGETYPE_GIF: $image = imagecreatefromgif($file); break;
      case IMAGETYPE_PNG: $image = imagecreatefrompng($file); break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);

      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color = imagecolorsforindex($image, $transparency);
        $transparency = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
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
      case IMAGETYPE_GIF: imagegif($image_resized, $output); break;
      case IMAGETYPE_JPEG: imagejpeg($image_resized, $output, $quality); break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }

    return true;
  }
?>