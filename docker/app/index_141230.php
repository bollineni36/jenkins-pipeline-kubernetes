<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		
		$db = new VDatabase(true);
		
			$query = sprintf("SELECT * FROM %s%s WHERE OfferActiveFlag = 'Active' AND OfferEndDate >= NOW() ORDER BY PublisherOfferId DESC LIMIT 20", DB_PREFIX, PUBLISHEROFFERS_TABLE);
			$rows = $db->getRows($query); 
		
		$db->closeConnection();
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsear Local Offers</title>
    
    <meta name="description" content="Your City. Your Deals and Events. Welcome to Konsear Local Offers! Konsear Local Offers brings you the best local deals and events in your community." /> 
	<meta name="keywords" content="local offers, coupons, daily deals, groupon, living social, deals, local events, deal of the day, half off deals, half off specials, online coupons, happy hour, wine tasting" /> 
	
	<?php include('includes.php'); ?>
	<style>
		.image { 
		   position: relative; 
		   width: 100%; /* for IE 6 */
		}
	</style>
	
	<!--Script for map-->
	<style type="text/css" media="screen">
         #map {
            position: relative;
            float: left;
            width: 700px;
            height: 350px;
            padding: 0px; 
        }
    </style>



    <script language="javascript" type="text/javascript">        
        function zoomOut() {
            var flashObj = swfobject.getObjectById("map");
            if (flashObj) {
              flashObj.zoomOut();
            }
        }
        
        function zoomTo(_state) {
            var flashObj = swfobject.getObjectById("map");
            if (flashObj) {
              flashObj.zoomTo(_state);
            }
        }
        
        function zoomPoint(_point) {
            var flashObj = swfobject.getObjectById("map");
            if (flashObj) {
              flashObj.zoomPoint(_point);
            }
        }        
		
        function setColor(_state, _color) {
            var flashObj = swfobject.getObjectById("map");
            if (flashObj) {
              flashObj.setColor(_state, _color);
            }
        }
		
        function refreshData(_data) {
            var flashObj = swfobject.getObjectById("map");
            if (flashObj) {
              flashObj.refreshData(_data);
            }
        }
    </script>
    <script type="text/javascript" src="maps/js/swfobject.js"></script>
	
    <script type="text/javascript">
        //swfobject.registerObject("DIYMap", "10.0.0");
        var flashvars = {
          data_file: "maps/xml/senate.xml",
          use_js: "on"
        };
        var params = {
          allowscriptaccess: "always"
        };
		//swfobject.embedSWF("maps/js/us_albers.swf", "map", "600", "400", "9.0.0", "expressInstall.swf", flashvars, params);
        swfobject.embedSWF("maps/js/us_albers.swf?guid=" + Math.random()*9999, "map", "700", "350", "9.0.0", "expressInstall.swf", flashvars, params);
		
		
    </script>
  </head>
  <body>
	
 	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	<div class="row" id="row">
		<div class="hideinmobile">
			<?php include('leftbar.php'); ?>
		    <div class="medium-6 columns">
				<div  class="vbottomspace">
					<div data-orbit id="slider">
						<!--<img src="images/road.jpg" />
						<img src="images/shelter.jpg" />
						<img src="images/sea.jpg" />-->
						<?php
							
									$image_dir = 'slider/';
									$thumb_dir = $image_dir.'/thumbs/';
									$per_column = 3;
									$files = array();
									$i = 0;
									$j = 1;
									if (!file_exists($image_dir))
									{
										//echo '<h3>There are no images in this gallery.</h3>';
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
										{ 	//echo '<h3>There are no images in this gallery.</h3>';	
										}
										if($i)
										{
											foreach($files as $file)
											{
												echo '<img src="'.$image_dir.$file.'" />';
											}
										}
									}
									
							
							
							?>
					</div>
				</div>
				<div class="medium-12 columns nopadding">
					<div id="map">
			            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			        </div>
					
					<p class="right">
			            <a href="javascript:zoomOut();">Zoom Out</a>
			        </p>
				</div>
					<div class="row collapse">
						<div class="medium-12 columns nopadding">
						<?php /*
							$i = 0;
							foreach($rows as $row)
							{
								$i++;
								$image = $row['OfferImage'];
								$offername = $row['OfferName'];
								$offerpercent = $row['OfferPercent'];
								if(is_numeric($offerpercent))
								 	$offerpercent = $offerpercent.'<span class="vpercentsize">%</span>';
								else
									$offerpercent = $offerpercent;
								$oid = $row['PublisherOfferId'];
								//$image = str_replace("thumb","full",$image);
								echo '<a href="offer_details.php?od='.$oid.'">';
								echo '<div class="medium-6 columns';
								if($i==1)
									echo " nopaddingleft";
								else
									echo " nopaddingright";
								echo '">';
								echo '<div class="offerback">';
								
								if($image == "")
								{
									echo '<img src="images/noimage.png" alt="" class="image"  />	
										  <p class="nobottom offer';
									if($i==1)
										echo' leftoffer">';
									else
										echo' rightoffer">';
									echo $offername.'</p>
										      <p class="nobottom percent vpercentfont';
									if($i==1)
										echo' leftpercent">';
									else
										echo' rightpercent">';
									echo $offerpercent.'</p>
										</img>';
								}
								else
								{
									echo '<img src="'.$image.'" alt="" class="image" />	
										  <p class="nobottom offer';
									if($i==1)
										echo' leftoffer">';
									else
										echo' rightoffer">';
									echo $offername.'</p>
										      <p class="nobottom percent vpercentfont';
									if($i==1)
										echo' leftpercent">';
									else
										echo' rightpercent">';
									echo $offerpercent.'</p>
										</img>';
								}
								
								echo '</div></div>';
								echo '</a>';
								if($i == 2)
								{
									echo "<p>&nbsp;</p></div><div class='medium-12 columns nopadding vbottomspace'>";
									$i=0;
								}
							} */
						?>
						</div>
						
					</div>	
			</div> 
		
			<?php include('rightbar.php'); ?>
		</div>
		
		<div class="showinmobile">
			<div class="medium-12 columns">
				<div  class="vbottomspace">
					<div data-orbit id="slider">
						<!--<img src="images/road.jpg" />
						<img src="images/shelter.jpg" />
						<img src="images/sea.jpg" />-->
						<?php
							
							$image_dir = 'slider/';
							$thumb_dir = $image_dir.'/thumbs/';
							$per_column = 3;
							$files = array();
							$i = 0;
							$j = 1;
							if (!file_exists($image_dir))
							{
								//echo '<h3>There are no images in this gallery.</h3>';
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
								{ 	//echo '<h3>There are no images in this gallery.</h3>';	
								}
								if($i)
								{
									foreach($files as $file)
									{
										echo '<img src="'.$image_dir.$file.'" />';
									}
								}
							}
							
						?>
					</div>
				</div>
				<div class="medium-12 columns nopadding">
					<div id="map">
			            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			        </div>
					
					<p class="right">
			            <a href="javascript:zoomOut();">Zoom Out</a>
			        </p>
				</div>
			</div>
			<?php include('leftbar.php'); ?>
			<?php include('rightbar.php'); ?>
		</div>
	</div>
 

  <!-- Footer -->
	 
	<?php include('footer1.php'); ?>

    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>