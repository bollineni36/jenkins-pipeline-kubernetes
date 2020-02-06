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
		<div class="hideinmobile"><?php include('leftbar.php'); ?></div>
	    <div class="medium-6 columns">
			<?php 
			if(isset($_SESSION['pubid']))
			{ ?>
				<h3 class="lightgrey">Welcome <?php echo $_SESSION['pname']?>! <br/>What do you want to Publish today?</h3>
			<?php } else { ?>
				<h3 class="lightgrey">It's Free… <br/>What do you want to Publish today?</h3>
			<?php } ?>
			<p><br/></p>
			<div class="medium-12 columns nopadding">
				<div class="small-3 columns nopadding">
					<a href="createoffer.php" class="button tiny radius restaurantbtn">Restaurant<br/>Offers</a>
				</div>
				<div class="small-1 columns nopadding">&nbsp;</div>
				<div class="small-4 columns nopadding textcenter">
					<div class="small-1 columns nopadding">&nbsp;</div>
					<div class="small-10 columns nopadding">
						<a href="createoffer.php" class="button tiny radius eventsbtn">General<br/>Events</a>
					</div>
					<div class="small-1 columns nopadding">&nbsp;</div>
				</div>
				<div class="small-1 columns nopadding">&nbsp;</div>
				<div class="small-3 columns nopadding">
					<a href="createoffer.php" class="button tiny radius happybtn">Happy<br/>Hour</a>
				</div>
			</div>
			<div class="medium-12 columns nopadding">
				<div class="small-6 columns nopadding textcenter">
					<div class="small-4 columns nopadding">&nbsp;</div>
					<div class="small-6 columns nopadding">
						<a href="createoffer.php" class="button tiny radius livebtn">Live<br/>Band</a>
					</div>
					<div class="small-2 columns nopadding">&nbsp;</div>
				</div>
				<div class="small-6 columns nopadding textcenter">
					<div class="small-2 columns nopadding">&nbsp;</div>
					<div class="small-6 columns nopadding">
						<a href="createoffer.php" class="button tiny radius spabtn">SPA<br/>Deals</a>
					</div>
					<div class="small-4 columns nopadding">&nbsp;</div>
				</div>
			</div>
			
			<div class="medium-12 columns nopadding">
				<div class="small-3 columns nopadding">
					<a href="createoffer.php" class="button tiny radius socialbtn">Social<br/>Events</a>
				</div>
				<div class="small-1 columns nopadding">&nbsp;</div>
				<div class="small-4 columns nopadding textcenter">
					<div class="small-1 columns nopadding">&nbsp;</div>
					<div class="small-10 columns nopadding">
						<a href="createoffer.php" class="button tiny radius winebtn">Wine<br/>Tasting</a>
					</div>
					<div class="small-1 columns nopadding">&nbsp;</div>
				</div>
				<div class="small-1 columns nopadding">&nbsp;</div>
				<div class="small-3 columns nopadding">
					<a href="createoffer.php" class="button tiny radius hotelbtn">Hotel<br/>Deals</a>
				</div>
			</div>
			<div class="medium-12 columns nopadding">
				<div class="small-6 columns nopadding textcenter">
					<div class="small-4 columns nopadding">&nbsp;</div>
					<div class="small-6 columns nopadding">
						<a href="createoffer.php" class="button tiny radius kidsbtn">Kids<br/>Activities</a>
					</div>
					<div class="small-2 columns nopadding">&nbsp;</div>
				</div>
				<div class="small-6 columns nopadding textcenter">
					<div class="small-2 columns nopadding">&nbsp;</div>
					<div class="small-6 columns nopadding">
						<a href="createoffer.php" class="button tiny radius communitybtn">Community<br/>Events</a>
					</div>
					<div class="small-4 columns nopadding">&nbsp;</div>
				</div>
			</div>
			
			<div class="medium-12 columns nopadding">
				<div class="small-3 columns nopadding">
					<a href="createoffer.php" class="button tiny radius shoppingbtn">Shopping<br/>Deals</a>
				</div>
				<div class="small-1 columns nopadding">&nbsp;</div>
				<div class="small-4 columns nopadding textcenter">
					<div class="small-1 columns nopadding">&nbsp;</div>
					<div class="small-10 columns nopadding">
						<a href="createoffer.php" class="button tiny radius sportsbtn">Sports<br/>Events</a>
					</div>
					<div class="small-1 columns nopadding">&nbsp;</div>
				</div>
				<div class="small-1 columns nopadding">&nbsp;</div>
				<div class="small-3 columns nopadding">
					<a href="createoffer.php" class="button tiny radius schoolbtn">School<br/>Events</a>
				</div>
			</div>
			<div class="medium-12 columns nopadding">
				<div class="small-6 columns nopadding textcenter">
					<div class="small-4 columns nopadding">&nbsp;</div>
					<div class="small-6 columns nopadding">
						<a href="createoffer.php" class="button tiny radius localbtn">Local<br/>Attractions</a>
					</div>
					<div class="small-2 columns nopadding">&nbsp;</div>
				</div>
				<div class="small-6 columns nopadding textcenter">
					<div class="small-2 columns nopadding">&nbsp;</div>
					<div class="small-6 columns nopadding">
						<a href="createoffer.php" class="button tiny radius offersbtn">General<br/>Offers</a>
					</div>
					<div class="small-4 columns nopadding">&nbsp;</div>
				</div>
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