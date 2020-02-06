<?php 
	require_once("../includes/start.php");
	require_once("../includes/config.php");
	require_once("../includes/tablenames.php");
	require_once("../includes/constants.php");
	require_once("../includes/classes/VDatabase.php");
	require_once("../includes/classes/VPagination.php");
	require_once("../includes/vutils.php");
	require_once("../includes/vlib.php");
	require_once("../includes/validations.php");
	require_once("../includes/SimpleImage.php");
	
		$db = new VDatabase(true);
		$message = "";
		if(!isset($_SESSION['oid']))
		{
			redirectPage('admin/login.php');
		}
		else
		{
			$ownid = $_SESSION['oid'];
		}
		$message = "";
		
		if(isset($_POST['submit']))
		{
			$file_exts = array("jpg", "jpeg", "gif", "png");
			//	$upload_exts = end(explode(".", $_FILES["file"]["name"]));
				if(isset($_FILES['file']) && !empty($_FILES['file']['name'])) 
				{
					if ((($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/png")
					|| ($_FILES["file"]["type"] == "image/pjpeg"))
					&& ($_FILES["file"]["size"] < 5000000))
					{
						if ($_FILES["file"]["error"] > 0)
						{
						$message = "Return Code: " . $_FILES["file"]["error"] . "<br>";
						}
						else
						{
								$filetype = $_FILES["file"]["type"];
								$filetype = str_replace("image/","",$filetype);
								
							    $target_folder = '../slider/'; 
								
								if (!file_exists($target_folder)) {
								    mkdir($target_folder, 0777, true);
								}
							//	mkdir($target_folder);
								
							    $upload_image = $target_folder.basename($_FILES['file']['name']);

							    $thumb = $target_folder.'thumbs/'.basename($_FILES['file']['name']);
								

							    $newwidth = "200";
							    $newheight = "150";

							    if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_image)) 
							    {
									smart_resize_image($upload_image, $newwidth, $newheight, false, $thumb, false, false, 100);
							    }
						}
					}
					else
					{
						$message = "Invalid file";
					}
				}
		}
	
	
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsear.com</title>
    
    <meta name="description" content="Konsear.com" />  
	
	
	<?php include('includes.php'); ?>
	<link rel="stylesheet" href="../css/style1.css" type="text/css" media="all">
	<style>
		#change-image { font-size: 0.8em; }
		a:hover, a:focus {
			color: #000000 !important;
		}
	</style>

  </head>
  <body>
	<?$page = "Change_Slider";?>
	<?php include('header.php'); ?>
	
	<div class="row">
		<p>&nbsp;</p>
		<?php include('leftbar.php'); ?>
		<div class="medium-1 columns">&nbsp;</div>
	    <div class="medium-7 columns">
			  <form name="slider" id="slider" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size" enctype="multipart/form-data">
				<div class="medium-12 columns bottomspace">
					
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<div class="medium-5 columns">
						<label class="">Slider Image</label>
					</div>
					<div class="medium-7 columns">
						<input type="file" name="file" id="file" value="">
					</div>
					<div class="medium-5 columns">&nbsp;</div>
					<div class="medium-7 columns">
							<input type="submit" name="submit" value="Upload" class="tiny button radius">
					</div>
					<hr/>
				</div>
			</form>
			<?php
						
						// for images
							echo '<div>';
						
								$image_dir = '../slider/';
								$thumb_dir = $image_dir.'thumbs/';
								$per_column = 3;
								$files = array();
								$i = 0;
								$j = 1;
								if (!file_exists($image_dir))
								{
									echo '<h4>There are no images in this gallery.</h3>';
								}
								else
								{
									// step one:  read directory, make array of files 
									if ($handle = opendir($image_dir))
									{
										while (false !== ($file = readdir($handle))) 
										{
											if ($file != '.' && $file != '..') 
											{
												if(preg_match('/[.](jpg)$/', $file)) {
													$files[] = $file;
													$i++;
												}else if(preg_match('/[.](JPG)$/', $file)) 
														{
															$files[] = $file;
															$i++;
														}
											}
										}
										closedir($handle);
									}
									
									//* step two: loop through, format gallery 
									if($i==0)
									{ 	echo '<h4>There are no images in this gallery.</h3>';	}
									if($i)
									{
										foreach($files as $file)
										{
											if($j == 4)
											{ $j = 1; }
											/*if(($j == $per_column) || ($j == 0))
											{ echo "<div class='row'>"; }*/
											echo '<div class="medium-4 columns textcenter" style="float:left; border: 1px solid #fff; border-radius: 5px; margin-bottom:10px;">';
												echo '<img src="',$thumb_dir,$file,'" /><br/><br/>';
												
						?>
												<a href="delete_slider_image.php?file=<?php echo $file;?>"><input type="button" value="Delete" class="button tiny radius"></a>
						<?php 
											 echo '<br/></div>';
											 
											/* if($j == $per_column)
											{ echo "</div>"; }*/
											$j++; 
										}
										if($j < $per_column)
											{ echo "</div>"; }
									}
								}
								
						
						
						?>
		</div> 
		<div class="medium-1 columns">&nbsp;</div>
		<div class="medium-12 columns"><p><br/></p></div>
	</div>
 

  <!-- Footer -->
	<?php include('footer1.php'); ?>

    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="../js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>