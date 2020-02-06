<?php 
	require_once("../includes/start.php");
	require_once("../includes/config.php");
	require_once("../includes/tablenames.php");
	require_once("../includes/constants.php");
	require_once("../includes/classes/VDatabase.php");
	require_once("../includes/vutils.php");
	require_once("../includes/vlib.php");
	require_once("../includes/validations.php");
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Happy Hour in New Haven | Konsear</title>
    
    <meta name="description" content="Konsear helps you find establishments that offer happy hour in New Haven. Get the app to receive updates & offers from businesses in your area." />  
    <meta  name="keywords" content="happy hour new haven, new haven happy hour, new haven happy hours, happy hours new haven, happy hour in new haven"/>
	
	
	<script src="../js/modernizr.js"></script>
	<link rel="stylesheet" href="../css/foundation.css" type="text/css" media="all">
	<?php
	/*<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="js/foundation.js"></script> */
	?>
		
	<link rel="stylesheet" href="../css/responsive-tables.css">
	<script src="stylesheet" href="../js/responsive-tables.js"></script>


	<script src="stylesheet" href="../js/jquery.dropdown.js"></script>

	<link rel="stylesheet" href="../css/style1.css" type="text/css" media="all">
	<style>
		#change-image { font-size: 0.8em; }
	</style>

  </head>
  <body>
	
  
	<?php include('../header.php'); ?>
	<?php include('../menu1.php'); ?>
	
	<div class="row">
		<div class="hideinmobile"><?php include('../leftbar.php'); ?></div>
	    <div class="medium-6 columns">
	    	<h1 class="pageheader">Happy Hour in New Haven</h1>
			<p>As a mobile app and website, Konsear serves as a powerful marketing tool for businesses and a dependable personal concierge for visitors and subscribers. Whether you’re a New Haven happy hour restaurant owner who wants to increase online exposure or a customer looking for a good place that offers discounted food and drinks, this concierge service will be of great help.</p>

			<p>What’s inn it for the Publishers or Businesses</p>

			<p>Konsear allows you to reach your target market by publishing the discount specials you offer during happy hours in New Haven, Connecticut. The app makes sure those who are looking for a great drinking spot will easily find your bar or restaurant. Before you know it, you’ll be serving more customers than you’ve ever had.</p>

			<p>What’s In It for the Subscribers and Visitors</p>

			<p>Konsear helps you find establishments that offer happy hour specials in New Haven. Get the app to receive updates and offers from multiple restaurants and bars in your area. More businesses are publishing their new offerings every day – be the first to know about them.</p>

			<p>Konsear serves as a virtual assistant that helps you choose among offers that match your areas of interest. It’s ideal and handy if you’re a traveler and are new to a particular place. The app shows you which establishments offer the best New Haven happy hour deals.</p>

			<p>The people who created Konsear aim to make the lives of publishers and subscribers easier. Get the app today to enjoy all the benefits it offers. Contact us if you have questions or concerns about this free concierge service.</p>

		</div> 
		<div class="showinmobile"><?php include('../leftbar.php'); ?></div>
		<?php include('../rightbar.php'); ?>
	</div>
 

  <!-- Footer -->
	<?php include('../footer1.php'); ?>

    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="../js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>