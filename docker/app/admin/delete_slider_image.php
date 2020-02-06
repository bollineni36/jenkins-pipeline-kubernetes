<?php
	ob_start();

	$file = $_GET['file'];
	//echo $filepath;
	$filepath = '../slider/'.$file;
	$thumbimage_path = '../slider/thumbs/'.$file;
	unlink($filepath);
	unlink($thumbimage_path);
	header("location:slider_images.php");
?>
