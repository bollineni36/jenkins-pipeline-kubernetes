<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		require_once("includes/SimpleImage.php");

		
		$db = new VDatabase(true);
		
		if(isset($_GET['od']))
		{
			$oid = $_GET['od'];
		}
		$daystart = date('Y-m-d 23:59:00');
		$dayend = date('Y-m-d 00:00:00');
		$query = sprintf("SELECT *,(SELECT OfferTypeName FROM kon_offertypes WHERE kon_publisheroffers.OfferTypeId = kon_offertypes.OfferTypeId) as OfferTypeName FROM %s%s WHERE OfferActiveFlag = 'Active' AND PublisherOfferId=%s AND OfferStartDate <= '$daystart' AND OfferEndDate >= '$dayend'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $oid);
		$row = $db->getRow($query); 
		//echo $query;
		if(!isset($row))
		{
			redirectPage('index.php');
		}
		else
		{
			
			$acid = $row['AccountId'];
			$offertype = $row['OfferTypeName'];
			$pubid = $row['PublisherOfferId'];
			$hits = $row['Hits'];
			$hits = $hits+1;
			$query2 = sprintf("UPDATE %s%s SET Hits = '%s' WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $hits, $pubid);
							
			$row2 = $db->updateRow($query2);
								
			$query1 = sprintf("SELECT * FROM %s%s WHERE AccountId = %s", DB_PREFIX, ACCOUNT_TABLE, $acid);
			$row1 = $db->getRow($query1);
			
			$regprice = $row['RegPrice'];
			$offerprice = $row['OfferPrice'];
			if(is_numeric($regprice))
				 	$regprice = "$".$regprice;
				else
					$regprice = "<span style='color: #cccccc;'>".$regprice."</span>";
					
			if(is_numeric($offerprice))
				 	$offerprice = "$".$offerprice;
				else
					$offerprice = "<span style='color: #cccccc;'>".$offerprice."</span>";
					
			$accountwebsite = $row1['AccountWebsite'];
			
			//To convert url
			$accountwebsite = addScheme($accountwebsite); 	
			
			/*if ((strpos($accountwebsite, 'http://') !== 0) || (strpos($accountwebsite, 'https://') !== 0))
			{
				$accountwebsite = "http://".$accountwebsite;
			}*/
			
			//To get keywords
			$keywords = "";
			$offername = $row['OfferName']." in ".$row1['AccountCity'];
			$str = $row['OfferName']." in ".$row1['AccountCity'];
			$words = explode(" ",$str);
			$num_words = count($words);
			for ($i = 0; $i < $num_words; $i++) {
			  for ($j = $i; $j < $num_words; $j++) {
				for ($k = $i; $k <= $j; $k++) {
					if($keywords == "")
						$keywords = $words[$k];
					else
						$keywords .= " ".$words[$k];
				}
				//print "\n";
				$keywords .= ",";
			  }
			}
		}
		$db->closeConnection();
	
	
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsear Local Offers | <?php echo $offername?></title>
    
    <meta name="description" content="Konsear helps you find establishments that offer <?php echo $offername?>. Get the app to receive updates & offers from businesses in your area." />  
    <meta name="keywords" content="local offers, coupons, daily deals, groupon, living social, deals, local events, deal of the day, half off deals, half off specials, online coupons, happy hour, wine tasting" />
	
	
	<?php include('includes.php'); ?>
	<link rel="stylesheet" href="css/style1.css" type="text/css" media="all">
	<style>
		#change-image { font-size: 0.8em; }
	</style>
	
	
  </head>
  <body>
	
  	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row">
		<div class="hideinmobile"><?php include('leftbar.php'); ?></div>
	    <div class="medium-6 columns">
			<h1 class="offerhead"><?php echo $row['OfferName']?></h1>
			<?php if($row['OfferImage'] != "") { $img = str_replace("thumb.","full.",$row['OfferImage']); ?><p class="textcenter"><img src="<?php echo BASE_URL.$img?>" style="max-height: 300px;"></p><?php } ?>
			<div class="medium-8 columns">
			<?php
				if($offertype == "Discount")
				{
					echo '<p class="nobottom offerdesc">Offer Type : '.$offertype.'</p>';
				}
			?>
			
			<?php
				if($offertype == "Discount")
				{
			?>
				<p class="nobottom offerdesc">Regular Price : <?php echo $regprice?></p>
				<p class="nobottom offerdesc">Offer Price : <?php echo $offerprice?></p>
			<?php 
				}
			?>
				<p class="nobottom offerdesc">Start Date : <?php echo toUSFormat($row['OfferStartDate'], FALSE)?></p>
				<p class="nobottom offerdesc">End Date : <?php echo toUSFormat($row['OfferEndDate'], FALSE)?></p>
			</div>
			
			<div class="medium-4 columns">
			<?
				$offerpercent = $row['OfferPercent'];
				
				if(is_numeric($offerpercent))
				 	$offerpercent = $offerpercent.'<span class="vpercentsize">%</span>';
				else
					$offerpercent = $offerpercent;
				if($offertype == "Discount")
					echo '<p class="nobottom vpercent vheadnormal right" style="position: relative;">'.$offerpercent.'</p>';
			?>
				
			</div>
			<div class="medium-12 columns">
				<p><?php echo $row['OfferDesc']?></p>
			</div>
			<div class="medium-12 columns nopadding">
				<div class="medium-4 columns nopadingleft"><p class="nobottom offerdesc">Location :</p> </div>
				<div class="medium-8 columns"><p class="nobottom " style="margin-top: 3px;"><?php echo $row1['AccountName']?><br/><?php echo $row1['AccountAddress1']?><br/><?php echo $row1['AccountCity']?><br/><?php echo $row1['AccountState']?> <?php echo $row1['AccountZipcode']?><br/><?php echo $row1['AccountCountry']?><br/><?php echo $row1['AccountPhone']?><br/><?php echo $row1['AccountEmailId']?><br/><a href="<?php echo $accountwebsite?>" target="_blank"><?php echo $row1['AccountWebsite']?></a></p></div>
			</div>
		</div> 
		<div class="showinmobile"><?php include('leftbar.php'); ?></div>
		<?php include('rightbar.php'); ?>
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