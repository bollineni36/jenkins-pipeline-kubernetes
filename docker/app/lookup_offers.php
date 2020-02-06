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
		if(isset($_POST['myoffers']))
		{
			$subid = $_SESSION['subid'];
			
			$query1 = sprintf("SELECT * FROM %s%s WHERE SubscriberId = '%s'", DB_PREFIX, SUBSCRIBERS_TABLE, $subid);
			
			$row = $db->getRow($query1); 
			//$zip = $row['SubscriberZipcode'];
			$cat = $row['InterestHeaders'];
			$subcat = $row['InterestDetailsId'];
			if($cat == "")
			{
				$catcond = "CategoryId > 0";
			}
			else 
			{
				
				$catids = explode(",",$cat);
				$i=0;
				foreach($catids as $id)
				{
					$i++;
					if($i == 1)
						$catcond = "CategoryId = '".$id."'";
					else
						$catcond .= " OR CategoryId = '".$id."'";
				}	
			}
			$catcond = str_replace(" OR CategoryId = ''","",$catcond);
			$catcond = "(".$catcond.")";
			
			if($subcat == "")
			{
				$subcatcond = "SubCategoryId > 0";
			}
			else 
			{
				
				$subcatids = explode(",",$subcat);
				$i=0;
				foreach($subcatids as $id)
				{
					$i++;
					if($i == 1)
						$subcatcond = "SubCategoryId = '".$id."'";
					else
						$subcatcond .= " OR SubCategoryId = '".$id."'";
				}	
			}
			$subcatcond = str_replace(" OR SubCategoryId = ''","",$subcatcond);
			$subcatcond = "(".$subcatcond.")";
		
			$query = sprintf("SELECT * FROM %s%s WHERE OfferActiveFlag = 'Active' AND %s AND %s AND OfferStartDate <= '$daystart' AND OfferEndDate >= '$dayend' ORDER BY PublisherOfferId DESC", DB_PREFIX, PUBLISHEROFFERS_TABLE, $catcond, $subcatcond);
			   
			//$query = sprintf("SELECT * FROM %s%s WHERE OfferActiveFlag = 'Active' AND OfferEndDate >= NOW() ORDER BY PublisherOfferId DESC", DB_PREFIX, PUBLISHEROFFERS_TABLE);
			
			$rows = $db->getRows($query); 
			
			$temp = 1;
		}
		else
		{
			
			$query = sprintf("SELECT * FROM %s%s WHERE OfferActiveFlag = 'Active' AND OfferStartDate <= '$daystart' AND OfferEndDate >= '$dayend' ORDER BY PublisherOfferId DESC", DB_PREFIX, PUBLISHEROFFERS_TABLE);
			
			$rows = $db->getRows($query); 
			
			$temp = 0;
		}
		$db->closeConnection();
		
		$h1tag = "Offer Lookup";
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
				<form name="showoffers" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="size">
				<?php 
					if(isset($_SESSION['subid']))
					{
						if($temp==0)
						{
				?>
							<div class="textcenter"><input type="submit" name="myoffers" id="myoffers" class="tiny button radius" value="Show My Offers"></div>
				<?
						}
						else
						{
				?>
							<div class="textcenter"><input type="submit" name="alloffers" id="alloffers" class="tiny button radius" value="Show All Offers"></div>
				<?		
						}
					}
				?>
				</form>
					<div class="row collapse">
					<?php
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
									echo '<div class="medium-12 columns vbottomspace">';
									echo '<a href="offer_details.php?od='.$oid.'">';
									echo '<div class="medium-12 columns ';
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
					</div>	
			</div> 
		<!--	<div class="showinmobile"><?php include('leftbar.php'); ?></div>-->
			<?php include('rightbar.php'); ?>
		</div>
		<div class="showinmobile">
			<div class="medium-12 columns">
				<form name="showoffers" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="size">
				<?php 
					if(isset($_SESSION['subid']))
					{
						if($temp==0)
						{
				?>
							<div class="textcenter"><input type="submit" name="myoffers" id="myoffers" class="tiny button radius" value="Show My Offers"></div>
				<?
						}
						else
						{
				?>
							<div class="textcenter"><input type="submit" name="alloffers" id="alloffers" class="tiny button radius" value="Show All Offers"></div>
				<?		
						}
					}
				?>
				</form>
					<div class="row collapse">
					<div class="vbottomspace"></div>
						<div class="medium-12 columns nopadding">
						<?
							$i = 0;
							$j = 0;
							foreach($rows as $row)
							{
								$i++;
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
								echo '<div class="medium-12 columns nopadding">';
									echo '<a href="offer_details.php?od='.$oid.'" class="vbottomspace">';
									echo '<div class="medium-12 columns nopadding">';
									
									echo '<div class="offerback">';
									echo '<div class="small-6 columns nopadding oprice"><span style="padding: 7px">'.$offerprice.'</span></div>';
									echo '<div class="small-6 columns nopadding odiscount"><span style="padding: 7px">'.$offerpercent.'</span></div>';
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
								
								echo '</div></div></div>';
								echo '</a>';
								
							}
							if($j == 0)
							{
								echo "<div class='alert-box success radius textcenter'>No offers</div>";
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