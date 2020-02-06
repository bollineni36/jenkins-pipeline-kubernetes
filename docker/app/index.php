<?php 
try{
	
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		
		
		$pageurl = "home";
		try{
			$db = new VDatabase(true);
		
		}
		catch(Exception $e)
		{
			print_r($e);
		}
		
			//$query = sprintf("SELECT * FROM %s%s WHERE OfferActiveFlag = 'Active' AND OfferEndDate >= NOW() ORDER BY PublisherOfferId DESC LIMIT 20", DB_PREFIX, PUBLISHEROFFERS_TABLE);
			//$rows = $db->getRows($query); 
			
			$cityquery = sprintf("SELECT DISTINCT AccountCity FROM kon_publisheroffers, kon_account WHERE kon_account.AccountId=kon_publisheroffers.AccountId AND OfferActiveFlag = 'Active' AND OfferEndDate >= NOW() ORDER BY AccountCity");
			
			$cities = $db->getRows($cityquery); 
			
			$searchzip = "";
			$searchcity = "";
			$searchoffertype = "";
			$searchcategory = "";
			$daystart = date('Y-m-d 23:59:00');
			$dayend = date('Y-m-d 00:00:00');
		
			if(isset($_POST['searchsubmit']))
			{
				$searchzip = $_POST['searchzip'];
				$searchcity = $_POST['searchcity'];
				$searchoffertype = $_POST['searchoffertype'];
				$searchcategory = $_POST['searchcategory'];
				
				$zipcond = "";
				$citycond = "";
				$offertypecond = "";
				$catcond = "";
				
				if($searchzip != "")
					$zipcond = " AND AccountZipcode = '".$searchzip."'";
				if($searchcity != "")
					$citycond = " AND AccountCity = '".$searchcity."'";
				if($searchoffertype != "")
					$offertypecond = " AND OfferTypeId = '".$searchoffertype."'";
				if($searchcategory != "")
					$catcond = " AND CategoryId = '".$searchcategory."'";
				
				$query = sprintf("SELECT * FROM kon_publisheroffers, kon_account WHERE kon_publisheroffers.AccountId = kon_account.AccountId AND OfferActiveFlag = 'Active' %s%s%s%s AND OfferStartDate <= '$daystart' AND OfferEndDate >= '$dayend' ORDER BY PublisherOfferId DESC", $zipcond, $citycond, $offertypecond, $catcond);
			   
				$rows = $db->getRows($query); 
			}
					
		$db->closeConnection();
		
		$h1tag = "Personal Concierge App";
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
    
    <!--Early Bird script-->
    
	
    <script>
    	function closepanel()
    	{
			$('.earlybird').hide();
		}
		function sendearlybirdmail()
		{
			var earlybirdemail = document.getElementById('earlybirdemail').value;
			//alert(earlybirdemail);
			var efilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var callajax = "true";
			if( earlybirdemail == "" )
			{
			     alert( "Please Fill Email" );
			     document.getElementById('earlybirdemail').focus() ;
			     callajax = "false";
			}
			else if (!efilter.test(earlybirdemail)) 
			{	
			     alert( "Please specify proper email address" );
			     document.getElementById('earlybirdemail').focus() ;
			     callajax = "false";
			}
			if(callajax == "true")
			{
				var emailid = earlybirdemail;
				  $.ajax({	
					url: "earlybird.php", //The url where the server req would we made.
					async: false, 
					type: "POST", //The type which you want to use: GET/POST
					data: "emailid="+emailid, //The variables which are going.
					dataType: "html", //Return data type (what we expect).
					
					//This is the function which will be called if ajax call is successful.
					success: function(data) {
						//data is the html of the page where the request is made.
						//alert(data);
					}
				})
				$('.earlybird').hide();	
			}
		}
    </script>
    <style>
    	.earlybird 
    	{
			display: block;
		}
    	.whitepanel 
    	{
			background: #f2f2f2;
			margin-bottom: 20px;
		}
		.topspace {
			padding-top: 10px;
		}
		.earlybirdtitle
		{
			color: #222;
		}
		#earlybirdemail
		{
			width: 100%;
		}
    </style>
    
    <script>
    	function isNumber(evt) {
		    evt = (evt) ? evt : window.event;
		    var charCode = (evt.which) ? evt.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        return false;
		    }
		    return true;
		}
    </script>
  </head>
  <body>
	
 	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row" id="row">
		<div class="earlybird">
			<div class="medium-12 columns">
				<div class="medium-12 columns whitepanel">
					<p><img src="images/cancel.png" class="right topspace" onclick="closepanel()"></p>
					<div class="medium-2 columns">&nbsp;</div>
					<div class="medium-8 columns">
						<div class="medium-12 columns">
							<div class="medium-2 columns">
								<p class="textcenter"><img src="images/samsung1.png"></p>
							</div>
							<div class="medium-8 columns">
								<h4 class="textcenter earlybirdtitle">WIN A SAMSUNG GALAXY TAB 4</h4>
								<h5 class="textcenter earlybirdtitle">Enter your email to win</h5>
								<input type="email" name="earlybirdemail" id="earlybirdemail" value="" required="true" placeholder="Email">
								<div class="textcenter">
									<input type="button" name="enter" id="enter" class="tiny button radius" value="Enter" onclick="sendearlybirdmail()"> 
									<input type="button" name="nothanks" id="nothanks" class="tiny button radius" value="No Thanks" onclick="closepanel()">		
								</div>
							</div>
							<div class="medium-2 columns">
								<p class="textcenter"><img src="images/samsung2.png"></p>
							</div>
						</div>
					</div>
					<div class="medium-2 columns">&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="hideinmobile">
			<?php include('leftbar.php'); ?>
		    <div class="medium-6 columns">
				<div class="vbottomspace">
					<div data-orbit id="slider">
						<!--<img src="images/road.jpg" />-->
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
				<div class="medium-12 columns nopadding" style="display: none">
					<div id="map">
			            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			        </div>
					
					<p class="right">
			            <a href="javascript:zoomOut();">Zoom Out</a>
			        </p>
				</div>
					<div class="row collapse">
						<div class="medium-12 columns nopadding">
						<form name="searchoffers" id="searchoffers" class="search" action="search_offers.php" method="POST" class="size">
							<div class="medium-2 columns nopadding" style="width: 21%">
								<input type="text" name="searchzip" id="searchzip" class="fullwidth" value="<?php if(isset($searchzip)) echo $searchzip; ?>" placeholder="Zip Code" maxlength="5" onkeypress="return isNumber(event)">
							</div>
							<div class="medium-2 columns nopadding" style="width: 21%">
								<select name="searchcity" id="searchcity" class="fullwidth">
									<option value="">City</option>
									<option value="all">All Cities</option>
									<?php
										foreach($cities as $row)
										{
											$city = $row['AccountCity'];
									?>
											<option value="<?php echo $city; ?>" <?php if($city == $searchcity) echo 'selected'; ?>><?php echo $city; ?></option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding" style="width: 21%">
								<select name="searchoffertype" id="searchoffertype" class="fullwidth">
									<option value="">Offer Type</option>
									<option value="all">All Offer Types</option>
									<?php
										$query = sprintf(" SELECT OfferTypeId, OfferTypeName FROM kon_offertypes WHERE OfferTypeActiveFlag = 'Active'");
										
										echo fillDropdown($query, (isset($searchoffertype) ? $searchoffertype : ''));
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding" style="width: 21%">
								<select name="searchcategory" id="searchcategory" class="fullwidth">
									<option value="">Category</option>
									<option value="all">All Categories</option>
									<?php
										$query = sprintf(" SELECT InterestHeaderId, InterestHeaderName FROM %s%s WHERE InterestHeaderActiveFlag = 'Active'", DB_PREFIX, INTERESTHEADER_TABLE);
										
										echo fillDropdown($query, (isset($searchcategory) ? $searchcategory : ''));
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding" style="width: 16%">
								<input type="submit" class="tiny button fullwidth" name="searchsubmit" id="searchsubmit" value="Search">
							</div>
						</form>
						<div class="medium-12 columns nopadding" style="display: none">
						<?php
						if(isset($rows))
						{
							
							$totalrows = count($rows);
							if($totalrows == 0)
							{
								echo "<div class='alert-box success radius textcenter'>No offers</div>";
							}
						?>
							<div class="medium-6 columns nopaddingleft">
							<?
								$i = 1;
								$j = 0;
								$totalrows = count($rows);
								$arraybreak = floor($totalrows/2);
								
									foreach($rows as $row)
									{
										$j++;
										
										$image = $row['OfferImage'];
										$offername = $row['OfferName'];
										$offerpercent = $row['OfferPercent'];
										$offerprice = $row['OfferPrice'];
										if(is_numeric($offerpercent))
										 	$offerpercent = $offerpercent.'<span class="vpercentsize">%</span>';
										else
											$offerpercent = '';
											
										if(is_numeric($offerprice))
										 	$offerprice = '$'.$offerprice;
										else
											$offerprice = '';
										$oid = $row['PublisherOfferId'];
										$image = str_replace("thumb","full",$image);
										echo '<div class="medium-12 columns vbottomspace nopadding">';
										echo '<a href="offer_details.php?od='.$oid.'">';
										echo '<div class="medium-12 columns nopadding';
										if($i==1)
											echo " nopaddingleft";
										else
											echo " nopaddingright";
										echo '">';
										echo '<div class="offerback">';
										echo '<div class="medium-6 columns nopadding oprice"><span style="padding: 7px">'.$offerprice.'</span></div>';
										echo '<div class="medium-6 columns nopadding odiscount"><span style="padding: 7px">'.$offerpercent.'</span></div>';
										if($image == "")
										{
											echo '<img src="images/noimage.png" alt="" class="image"  /></img>';
										}
										else
										{
											echo '<img src="'.$image.'" alt="" class="image" /></img>';
										}
										echo '<p class="offerhead"> ';
											echo $offername.'</p>';
											
										echo '</div></div>';
										echo '</a></div>';
										if($j == $arraybreak)
										{
											echo "<p>&nbsp;</p></div><div class='medium-6 columns nopaddingright'>";
											$i=0;
										}
									}
								
							?>
							</div>
						<?php	
							}
						?>
						</div>
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
				
				<div class="row collapse">
						<div class="medium-12 columns nopadding">
						<form name="searchoffers" id="searchoffers" class="search" action="search_offers.php" method="POST" class="size">
							<div class="medium-2 columns nopadding">
								<input type="text" name="searchzip" id="searchzip" class="fullwidth" value="<?php if(isset($searchzip)) echo $searchzip; ?>" placeholder="Zip Code" maxlength="5" onkeypress="return isNumber(event)">
							</div>
							<div class="medium-2 columns nopadding">
								<select name="searchcity" id="searchcity" class="fullwidth">
									<option value="">Select City</option>
									<option value="all">All Cities</option>
									<?php
										foreach($cities as $row)
										{
											$city = $row['AccountCity'];
									?>
											<option value="<?php echo $city; ?>" <?php if($city == $searchcity) echo 'selected'; ?>><?php echo $city; ?></option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding">
								<select name="searchoffertype" id="searchoffertype" class="fullwidth">
									<option value="">Select Offer Type</option>
									<option value="all">All Offer Types</option>
									<?php
										$query = sprintf(" SELECT OfferTypeId, OfferTypeName FROM kon_offertypes WHERE OfferTypeActiveFlag = 'Active'");
										
										echo fillDropdown($query, (isset($searchoffertype) ? $searchoffertype : ''));
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding">
								<select name="searchcategory" id="searchcategory" class="fullwidth">
									<option value="">Select Category</option>
									<option value="all">All Categories</option>
									<?php
										$query = sprintf(" SELECT InterestHeaderId, InterestHeaderName FROM %s%s WHERE InterestHeaderActiveFlag = 'Active'", DB_PREFIX, INTERESTHEADER_TABLE);
										
										echo fillDropdown($query, (isset($searchcategory) ? $searchcategory : ''));
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding">
								<input type="submit" class="tiny button fullwidth" name="searchsubmit" id="searchsubmit" value="Search">
							</div>
						</form>
						
						</div>
						
					</div>
					
				<div class="medium-12 columns nopadding">
					<!--<div id="map">
			            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			        </div>
					
					<p class="right">
			            <a href="javascript:zoomOut();">Zoom Out</a>
			        </p>-->
					
					
					<!--<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="500" height="297" id="zoom_map" align="top">
					<param name="movie" value="us.swf?data_file=maps/xml/senate.xml" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FFFFFF" />
					<embed src="us.swf?data_file=maps/xml/senate.xml" quality="high" bgcolor="#FFFFFF"  width="500" height="297" name="Clickable U.S. Map" align="top" 
					type="application/x-shockwave-flash" 
					pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
					</object><br />-->
					<div id="maps" style="width: 100%; display: none;"></div>
				</div>
			</div>
			<?php include('leftbar.php'); ?>
			<?php include('rightbar.php'); ?>
		</div>
	</div>
 

  <!-- Footer -->
	 
	<?php include('footer1.php'); ?>

	<script src="simplemap/mapdata.js"></script>
	<script src="simplemap/usmap.js"></script>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>
<?php
}
catch(Exception $e)
{
	print_r($e);
}
?>