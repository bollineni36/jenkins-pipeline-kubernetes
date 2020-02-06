<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsear Local Offers</title>
    
    <meta name="description" content="Your City. Your Deals and Events. Welcome to Konsear Local Offers! Konsear Local Offers brings you the best local deals and events in your community." /> 
	<meta name="keywords" content="local offers, coupons, daily deals, groupon, living social, deals, local events, deal of the day, half off deals, half off specials, online coupons, happy hour, wine tasting" /> 
	
	<?php $this->load->view('includes'); ?>
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style1.css" type="text/css" media="all">
  </head>
  <body>
	
	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row">
		<div class="medium-3 columns">
		 	<div id="menu4" class="vbottomspace">
				<ul>
					<li id="abc">Most Popular</li> 
					<li><a rel="nofollow" href="#">New York</a></li> 
					<li><a rel="nofollow" href="#">Los Angeles</a></li> 		
					<li><a rel="nofollow" href="#">Las Vegas</a></li> 
					<li><a rel="nofollow" href="#">San Fransisco</a></li> 
					<li><a rel="nofollow" href="#">Dallas</a></li>
					<li><a rel="nofollow" href="#">San Diego</a></li>
					<li><a rel="nofollow" href="#">Missouri</a></li>
					<li><a rel="nofollow" href="#">Virginia</a></li>
					<li><a rel="nofollow" href="#">Georgia</a></li>
					<li><a rel="nofollow" href="#">Texas</a></li>		
				</ul>
			</div>
			<div class="vbottomspace">
				<p class="heading">Top Picks</p>
				<p class="toppicks"><img src="<?php echo base_url()?>assets/images/kid.png"></p>
			</div>
			
			<div class="vbottomspace">
				<p class="heading">Top Picks</p>
				<p class="toppicks"><img src="<?php echo base_url()?>assets/images/kid.png"></p>
			</div>
		</div>
	    <div class="medium-6 columns">
			<div align="center">
				<p>Thanks for signing in Konsear.com. Please check your mail for Login details</p>
			</div>
		</div> 
		<div class="medium-3 columns">
			<div  id="sidelinks" class="vbottomspace">
				<ul>
					<li id="abc">Most Popular Now</li> 
					<li><a rel="nofollow" href="#"><p class="nobottom"><span class="smallfont">>></span> 20% off on Peter England Shirts</p></a></li> 
					<li><a rel="nofollow" href="#"><p class="nobottom"><span class="smallfont">>></span> 20% off on Peter England Shirts</p></a></li> 
					<li><a rel="nofollow" href="#"><p class="nobottom"><span class="smallfont">>></span> 20% off on Peter England Shirts</p></a></li> 
					<li><a rel="nofollow" href="#"><p class="nobottom"><span class="smallfont">>></span> 20% off on Peter England Shirts</p></a></li> 
					<li><a rel="nofollow" href="#"><p class="nobottom"><span class="smallfont">>></span> 20% off on Peter England Shirts</p></a></li> 
					<li><a rel="nofollow" href="#"><p class="nobottom"><span class="smallfont">>></span> 20% off on Peter England Shirts</p></a></li> 
				</ul>		
			</div>
			<div class=" vbottomspace">
				<div class="row collapse sidezipcode">
					<p style="margin:10px;" class="textcenter">Enter zipcode to search nearest offers to you</p>
					<div class="medium-1 columns">&nbsp;</div>
					<div class="medium-10 columns">
						<p class="textcenter nobottom">
							<input type="text" name="search" id="search" value="">
							<input type="submit" name="submit" id="submit" value="Go" class="tiny button radius">
						</p>
					</div>
					<div class="medium-1 columns">&nbsp;</div>
				</div>
			</div>
			
			<div class="row collapse">
				<img src="<?php echo base_url()?>assets/images/android.png">
			</div>
		</div>	
	</div>
 

  <!-- Footer -->
	 <?php $this->load->view('footer1'); ?>
	

    <script src="<?php echo base_url()?>assets/js/jquery-1.8.2.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>