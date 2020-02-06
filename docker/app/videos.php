<?php 
	require_once("includes/start.php");
	require_once("includes/config.php");
	require_once("includes/tablenames.php");
	require_once("includes/constants.php");
	require_once("includes/classes/VDatabase.php");
	require_once("includes/vutils.php");
	require_once("includes/vlib.php");
	require_once("includes/validations.php");
	
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
	
  
	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row">
		<!--<div class="hideinmobile"><?php include('leftbar.php'); ?></div>-->
	    <div class="medium-12 columns">
			<h3 class="lightgrey">Videos</h3>
			<div class="medium-12 columns">
				<h5>Click the video below if you are a <a href="#" class="tooltip">Business Owner (Publisher)</a><span data-tooltip aria-haspopup="true" class="has-tip" title="<h5>Who are our Publishers?</h5>
				<ul class='vtooltipsize'>
					<li>Restaurants & Bars </li> 
					<li>Wine Stores</li>
					<li>SPAs </li> 
					<li>Hotels / Motels</li>
					<li>Retail Stores </li> 
					<li>Non - Profit Organizations</li>
					<li>Local Communities </li> 
					<li>Local Services (Maid Service, Handyman etc.)</li>
					<li>Schools (Public & Private) </li> 
					<li>Corporates</li>
					<li>Wedding Consultants </li> 
					<li>and many more ......</li>
				</ul>">Business Owner (Publisher)</span> and want to learn how your offers will instantly reach your customers</h5>
				<div class="medium-8 columns">
					<div class="flex-video widescreen">
						<iframe width="480" height="250" src="https://www.youtube.com/embed/4oCWL075TrE?rel=0" frameborder="0" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="medium-1 columns">&nbsp;</div>
				<div class="medium-3 columns">
					<div class="offerpanel">
						<h5 class="lightblackcolor">Free 90-day trial</h5>
						<ul style="list-style: circle; color: #4b4b4b;">
							<li><h6 class="lightblackcolor">No Setup Fees</h6></li>
							<li><h6 class="lightblackcolor">No Contract</h6></li>
							<li><h6 class="lightblackcolor">No Credit Card</h6></li>
							<li><h6 class="lightblackcolor">Cancel Anytime</h6></li>
						</ul>
						<div class="textcenter"><input type="button" class="tiny button radius nobottom" name="getstarted" value="Get Started" onclick="location.href = '<?php echo BASE_URL?>plans_pricing.php';" /></div>
					</div>
				</div>
			</div>
			
			<div class="medium-12 columns">
				<h5>Click the video below if you would like to use Konsear to get the offers or event announcements from your favorite vendors.</h5>
				<div class="medium-8 columns">
					<div class="flex-video widescreen">
						<iframe width="480" height="250" src="https://www.youtube.com/embed/5IndrICQn7Y?rel=0" frameborder="0" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="medium-1 columns">&nbsp;</div>
				<div class="medium-3 columns">
					<div class="offerpanel">
						<h5 class="lightblackcolor textcenter">Download a Free App</h5>
						<p class="textcenter"><a href="https://play.google.com/store/apps/details?id=com.konsear.ncplinc" target="_blank"><img src="<?php echo BASE_URL?>images/playstore.png"></a></p>
						<p class="textcenter"><a href="#"><img src="<?php echo BASE_URL?>images/appstore.png"></a></p>
					</div>
				</div>
			</div>
		</div> 
		<!--<div class="showinmobile"><?php include('leftbar.php'); ?></div>
		<?php include('rightbar.php'); ?>-->
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