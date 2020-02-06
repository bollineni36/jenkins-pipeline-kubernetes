<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		
		$db = new VDatabase(true);
		
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
					
				if($searchcity == "all")
					$citycond = " AND AccountCity Like '%'";
				elseif($searchcity != "" && $searchcity != "all")
					$citycond = " AND AccountCity = '".$searchcity."'";
				
				
				if($searchoffertype == "all")
					$offertypecond = " AND OfferTypeId > '0'";
				elseif($searchoffertype != "" && $searchoffertype != "all")
					$offertypecond = " AND OfferTypeId = '".$searchoffertype."'";
				
				
				if($searchcategory == "all")
					$catcond = " AND CategoryId > '0'";
				elseif($searchcategory != "" && $searchcategory != "all")
					$catcond = " AND CategoryId = '".$searchcategory."'";
					
				/*if($searchoffertype != "")
					$offertypecond = " AND OfferTypeId = '".$searchoffertype."'";
				if($searchcategory != "")
					$catcond = " AND CategoryId = '".$searchcategory."'";*/
				
				$query = sprintf("SELECT * FROM kon_publisheroffers, kon_account WHERE kon_publisheroffers.AccountId = kon_account.AccountId AND OfferActiveFlag = 'Active' %s%s%s%s AND OfferStartDate <= '$daystart' AND OfferEndDate >= '$dayend' ORDER BY PublisherOfferId DESC", $zipcond, $citycond, $offertypecond, $catcond);
			   
				$rows = $db->getRows($query); 
			}
		$db->closeConnection();
		
		$h1tag = "Search Offers";
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsear Local Offers | Lookup Offers</title>
    
    <meta name="description" content="Your City. Your Deals and Events. Welcome to Konsear Local Offers! Konsear Local Offers brings you the best local deals and events in your community." />
	<meta name="keywords" content="local offers, coupons, daily deals, groupon, living social, deals, local events, deal of the day, half off deals, half off specials, online coupons, happy hour, wine tasting" />
	
	<?php include('includes.php'); ?>
	<style>
		.image { 
		   position: relative; 
		   width: 100%; /* for IE 6 */
		}
	</style>
		
  </head>
  <body>
	
 	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	<div class="row" id="row">
		<div class="hideinmobile">
			<?php include('leftbar.php'); ?>
		    <div class="medium-6 columns">
				<div class="row collapse">
						<div class="medium-12 columns nopadding">
						<form name="searchoffers" id="searchoffers" class="search" action="search_offers.php" method="POST" class="size">
							<div class="medium-2 columns nopadding" style="width: 21%">
								<input type="text" name="searchzip" id="searchzip" class="fullwidth" value="<?php if(isset($searchzip)) echo $searchzip; ?>" placeholder="Zip Code" maxlength="5" onkeypress="return isNumber(event)">
							</div>
							<div class="medium-2 columns nopadding" style="width: 21%">
								<select name="searchcity" id="searchcity" class="fullwidth">
									<option value="">City</option>
									<option value="all" <?php if($searchcity == "all") echo 'selected'; ?>>All</option>
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
									<option value="all" <?php if($searchoffertype == "all") echo 'selected'; ?>>All Offer Types</option>
									<?php
										$query = sprintf(" SELECT OfferTypeId, OfferTypeName FROM kon_offertypes WHERE OfferTypeActiveFlag = 'Active'");
										
										echo fillDropdown($query, (isset($searchoffertype) ? $searchoffertype : ''));
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding" style="width: 21%">
								<select name="searchcategory" id="searchcategory" class="fullwidth">
									<option value="">Category</option>
									<option value="all" <?php if($searchcategory == "all") echo 'selected'; ?>>All Categories</option>
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
						<div class="medium-12 columns nopadding">
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
						</div>
						
					</div>
			</div> 
		<!--	<div class="showinmobile"><?php include('leftbar.php'); ?></div>-->
			<?php include('rightbar.php'); ?>
		</div>
		<div class="showinmobile">
			<div class="medium-12 columns">
				<form name="searchoffers" id="searchoffers" class="search" action="search_offers.php" method="POST" class="size">
							<div class="medium-2 columns nopadding">
								<input type="text" name="searchzip" id="searchzip" class="fullwidth" value="<?php if(isset($searchzip)) echo $searchzip; ?>" placeholder="Zip Code" maxlength="5" onkeypress="return isNumber(event)">
							</div>
							<div class="medium-2 columns nopadding">
								<select name="searchcity" id="searchcity" class="fullwidth">
									<option value="">City</option>
									<option value="all" <?php if($searchcity == "all") echo 'selected'; ?>>All</option>
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
									<option value="">Offer Type</option>
									<option value="all" <?php if($searchoffertype == "all") echo 'selected'; ?>>All Offer Types</option>
									<?php
										$query = sprintf(" SELECT OfferTypeId, OfferTypeName FROM kon_offertypes WHERE OfferTypeActiveFlag = 'Active'");
										
										echo fillDropdown($query, (isset($searchoffertype) ? $searchoffertype : ''));
									?>
								</select>
							</div>
							<div class="medium-2 columns nopadding">
								<select name="searchcategory" id="searchcategory" class="fullwidth">
									<option value="">Category</option>
									<option value="all" <?php if($searchcategory == "all") echo 'selected'; ?>>All Categories</option>
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
					<div class="row collapse">
					<div class="vbottomspace"></div>
						<div class="medium-12 columns nopadding">
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
					</div>	
			</div>
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