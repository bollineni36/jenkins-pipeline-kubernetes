<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
	
	if(!isset($_SESSION['pubid']))
	{
		redirectPage('login.php');
	}
	else
	{
		$pubid = $_SESSION['pubid'];
	}
	$message = "";
	
	
	$db = new VDatabase(true);
	
	$subcount = 0;
	
	if(isset($_POST['submit']))
	{
		$zip = $_POST['zip'];
		$category = $_POST['category'];
						
		if($zip > 0 && $category > 0)
		{
			
			$zipcond = "(SubscriberZipcode = '".$zip."')";
			$catcond = "((InterestHeaders LIKE '".$category.",%') OR (InterestHeaders LIKE '%,".$category.",%') OR (InterestHeaders = ''))";
			
			$cond = $zipcond. " AND " .$catcond;
			
			$query = sprintf("SELECT count(*) as subcount FROM %s%s WHERE %s", DB_PREFIX, SUBSCRIBERS_TABLE, $cond);
		}
		else
		{
			if($zip > 0)
			{
				$zipcond = "(SubscriberZipcode = '".$zip."')";
				
				$cond = $zipcond;
				
				$query = sprintf("SELECT count(*) as subcount FROM %s%s WHERE %s", DB_PREFIX, SUBSCRIBERS_TABLE, $cond);
			}
			elseif($category > 0)
			{
				$catcond = "((InterestHeaders LIKE '".$category.",%') OR (InterestHeaders LIKE '%,".$category.",%') OR (InterestHeaders = ''))";
				
				$cond = $catcond;
				
				$query = sprintf("SELECT count(*) as subcount FROM %s%s WHERE %s", DB_PREFIX, SUBSCRIBERS_TABLE, $cond);
			}
			else
			{
				$message = "Please fill zip code or select category";
			}
		}
		
		//echo $query = sprintf("SELECT count(*) as subcount FROM %s%s WHERE %s", DB_PREFIX, SUBSCRIBERS_TABLE, $cond);
		if(isset($query))	
		{
			//echo $query;
			$rows = $db->getRow($query); 
			$subcount = $rows['subcount'];	
			$temp = 1;
		}
		
	}
	if(isset($_POST['submits']))
	{
		$offer = $_POST['offer'];
		
		if($offer > 0)
		{
			$query = sprintf("SELECT count(*) as subcount FROM %s%s WHERE SubscribertagActiveFlag = 'Active' AND PublisherOfferId = %s", DB_PREFIX, SUBSCRIBERTAGS_TABLE, $offer);
		
			//echo $query;
			$rows = $db->getRow($query); 
			$subcount = $rows['subcount'];	
			$temps = 1;	
		}
		else
		{
			$message = "Please select an offer";
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
    <title>Konsear Local Offers</title>
    
    <meta name="description" content="Your City. Your Deals and Events. Welcome to Konsear Local Offers! Konsear Local Offers brings you the best local deals and events in your community." /> 
	<meta name="keywords" content="local offers, coupons, daily deals, groupon, living social, deals, local events, deal of the day, half off deals, half off specials, online coupons, happy hour, wine tasting" /> 
	
	
	<?php include('includes.php'); ?>
	<link rel="stylesheet" href="css/style1.css" type="text/css" media="all">
	<style>
		#change-image { font-size: 0.8em; }
	</style>
  </head>
  <body>
	
  <!--<div class="row">
    <div class="medium-3 columns">
      <h1><a href="<?php echo BASE_URL?>"><img src="images/logok.png" /></a></h1>
    </div>
  	<div class="medium-9 columns">
		
		<a href="https://twitter.com/konsear" target="_blank"><img src="images/twit.gif" alt="social links" class="socialnet"/></a> 
		<a href="https://www.facebook.com/#!/Konsear" target="_blank"> <img src="images/facebook.gif" alt="social links" class="socialnet"></a>  
  	</div>
  </div>-->
	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row" style="min-height: 400px;">
		<?php //include('leftbar.php'); ?>
		<div class="medium-1 columns">&nbsp;</div>
	    <div class="medium-10 columns">
			<form name="dashboard" id="dashboard" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size">
				<?php if($message != "") echo "<div class='medium-12 columns'><div class='medium-3 columns'>&nbsp;</div><div class='medium-6 columns'><div class='alert-box success radius textcenter'>".$message."</div></div><div class='medium-3 columns'>&nbsp;</div></div>"; ?>
			  <div class='medium-12 columns'>
			  	<p class="textcenter">"Please leave empty for ALL zip codes in zip code textbox."</p>	
				<div class="medium-1 columns">&nbsp;</div>
				<div class="medium-4 columns">
					<label class="inline">Zip Code</label>
					<input type="text" name="zip" id="zip" value="<?php if(isset($zip)) echo $zip; ?>" placeholder="zipcode">	
				</div>
				<div class="medium-4 columns">
					<label class="inline">Category</label>
					<select name="category" id="category">
						<option value="">Select Category</option>
						<?php
							$query = sprintf(" SELECT InterestHeaderId, InterestHeaderName FROM %s%s WHERE InterestHeaderActiveFlag = 'Active'", DB_PREFIX, INTERESTHEADER_TABLE);
							
							echo fillDropdown($query, (isset($category) ? $category : ''));
						?>
					</select>
				</div>
				<div class="medium-2 columns">
					<label style="padding-bottom: 12px;">&nbsp;</label>
					<input type="submit" name="submit" id="submit" value="Submit" class="tiny button radius">
				</div>
				<div class="medium-1 columns">&nbsp;</div>
			  </div>
			</form>
			<p class="textcenter">OR</p>
			<form name="dashboard" id="dashboard" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size">
			  <div class='medium-12 columns'>	
				<div class="medium-3 columns">&nbsp;</div>
				<div class="medium-4 columns">
					<label class="inline">Offer Name</label>
					<select name="offer" id="offer">
						<option value="">Select Offer</option>
						<?php
							$query = sprintf("SELECT PublisherOfferId, OfferName FROM %s%s WHERE PublisherId = %s", DB_PREFIX, PUBLISHEROFFERS_TABLE, $pubid);
							
							echo fillDropdown($query, (isset($offer) ? $offer : ''));
						?>
					</select>
				</div>
				<div class="medium-2 columns">
					<label style="padding-bottom: 12px;">&nbsp;</label>
					<input type="submit" name="submits" id="submits" value="Submit" class="tiny button radius">
				</div>
				<div class="medium-3 columns">&nbsp;</div>
			  </div>
			</form>
			<div class="medium-12 columns">
				<div class="medium-1 columns">&nbsp;</div>
			<?php
				if(isset($temp))
				{
					echo "<div class='medium-10 columns'><p class='vmininormal'>Result:</p><p class='vmininormal offerhead'>Subscribers count: ".$subcount."<p></div>";	
				}
				if(isset($temps))
				{
					echo "<div class='medium-10 columns'><p class='vmininormal'>Result:</p><p class='vmininormal offerhead'>Subscribers count: ".$subcount."<p></div>";	
				}
			?>
				<div class="medium-1 columns">&nbsp;</div>
			</div>
		</div> 
		<div class="medium-1 columns">&nbsp;</div>
		<?php //include('rightbar.php'); ?>
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




SELECT SubscriberZipcode, count( * )
FROM kon_subscribers
GROUP BY SubscriberZipcode
ORDER BY SubscriberZipcode DESC

Select SubscriberZipcode,InterestHeaders,count(*) from kon_subscribers group by SubscriberZipcode, InterestHeaders order by InterestHeaders, SubscriberZipcode  asc

SELECT SubscriberZipcode, InterestHeaders, count( * ) FROM kon_subscribers GROUP BY InterestHeaders ORDER BY SubscriberZipcode, InterestHeaders ASC

SELECT SubscriberZipcode, InterestHeaders, count( * ) FROM kon_subscribers s INNER JOIN kon_interestheader h ON h.InterestHeaderId=s.InterestHeaders GROUP BY InterestHeaders ORDER BY SubscriberZipcode, InterestHeaders ASC

SELECT SubscriberZipcode, InterestHeaders, count( * )
FROM kon_subscribers
WHERE InterestHeaders LIKE "%2,%"
GROUP BY SubscriberZipcode
ORDER BY SubscriberZipcode, InterestHeaders ASC