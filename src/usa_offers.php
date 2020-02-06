<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		
		$db = new VDatabase(true);
		
		$daystart = date('Y-m-d 23:59:00');
		$dayend = date('Y-m-d 00:00:00');
			$query = sprintf("SELECT * FROM %s%s o, %s%s a WHERE o.OfferActiveFlag = 'Active' AND a.AccountId = o.AccountId AND a.AccountCountry = 'US' AND OfferStartDate <= '$daystart' AND OfferEndDate >= '$dayend' ORDER BY PublisherOfferId DESC", DB_PREFIX, PUBLISHEROFFERS_TABLE, DB_PREFIX, ACCOUNT_TABLE);
			
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
	<div class="row">
		<div class="hideinmobile">
			<?php include('leftbar.php'); ?>
	    	<div class="medium-6 columns">
			
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
						$j = 0;
						foreach($rows as $row)
						{
							$i++;
							$j++;
							$image = $row['OfferImage'];
							$offername = $row['OfferName'];
							$offerpercent = $row['OfferPercent'];
							if(is_numeric($offerpercent))
							 	$offerpercent = $offerpercent.'<span class="vpercentsize">%</span>';
							else
								$offerpercent = $offerpercent;
							$oid = $row['PublisherOfferId'];
							$image = str_replace("thumb","full",$image);
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
						}
						if($j==0)
						{
							echo "<div class='textcenter'>No offers in USA</div>";
						}*/
					?>
					</div>
				</div>	
			</div>
			<?php include('rightbar.php'); ?>
		</div> 
		<div class="showinmobile">
			<?php include('leftbar.php'); ?>
			<div class="medium-6 columns">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="500" height="297" id="zoom_map" align="top">
				<param name="movie" value="us.swf?data_file=maps/xml/senate.xml" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#FFFFFF" />
				<embed src="us.swf?data_file=maps/xml/senate.xml" quality="high" bgcolor="#FFFFFF"  width="500" height="297" name="Clickable U.S. Map" align="top" 
				type="application/x-shockwave-flash" 
				pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
				</object><br />
			</div>
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