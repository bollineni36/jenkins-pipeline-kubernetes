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
			<!--<h3 class="lightgrey">How it works?</h3>
			<div class="flex-video widescreen">
				<iframe width="480" height="250" src="//www.youtube.com/embed/lu3JQfu_vTc?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>-->
			<h3 class="lightgrey textcenter">How It Works</h3>
			<div class="medium-12 columns nopadding">
				<div class="medium-4 columns">
					<div class="medium-2 columns">&nbsp;</div>
					<div class="medium-8 columns">
						<img src="images/register_image.png"/>
					</div>
					<div class="medium-2 columns">&nbsp;</div>
					
					<h4 class="textcenter"><span class="vbold">Register Your Business</span><br/>Get your Publisher <br/>Account in few minutes</h4>
				</div>
				<div class="medium-4 columns">
					<div class="medium-2 columns">&nbsp;</div>
					<div class="medium-8 columns">
						<img src="images/globe_pic.png"/>
					</div>
					<div class="medium-2 columns">&nbsp;</div>
					<h4 class="textcenter"><span class="vbold">Create & Publish Offers</span><br/>Manage your offers from anywhere and anytime</h4>
				</div>
				<div class="medium-4 columns">
					<div class="medium-2 columns">&nbsp;</div>
					<div class="medium-8 columns">
						<img src="images/subscribers.png"/>
					</div>
					<div class="medium-2 columns">&nbsp;</div>
					<h4 class="textcenter"><span class="vbold">Reach our Subscribers</span><br/>Your offers will reach our subscribers instantly</h4>
				</div>
			</div>
			<p>&nbsp;</p>
			
			<h3 class="lightgrey textcenter">What You Get</h3>
			<div class="medium-12 columns nopadding">
				<div class="medium-4 columns">
					<div class="medium-12 columns bluebox">
						<h4 class="textcenter vwhitefont">Digital Offer</h4>
						<p class="textcenter">You can create your own digital offer using our state of art software and publish the offer in few minutes. It is very easy to manage the offers, You can create multiple offers at the same time and control the start and expiry date of an offer.
					</div>
					<p>&nbsp;</p>
				</div>
				<div class="medium-4 columns">
					<div class="medium-12 columns bluebox">
						<h4 class="textcenter vwhitefont">Social Deals</h4>
						<p class="textcenter">You will be able to share your digital offer in any social networking sites. <br/>Our subscribers will be able to match their interest with your offers.</p>
					</div>
					<p>&nbsp;</p>
				</div>
				<div class="medium-4 columns">
					<div class="medium-12 columns bluebox">
						<h4 class="textcenter vwhitefont">Measure Campaign</h4>
						<p class="textcenter">Konsear provides the after market information to publishers, so they can reach out to their target audience.<br/>This will help businesses to manage their inventory effectively and increase their sales.</p>
					</div>
					<p>&nbsp;</p>
				</div>
				<div class="medium-4 columns">
					<div class="medium-12 columns bluebox">
						<h4 class="textcenter vwhitefont">Dashboard</h4>
						<p class="textcenter">Konsear provides a mini dashboard to publishers and they can create analytical reports on many key performance indicators for their business that will help them achieve their business goals.
					</div>
					<p>&nbsp;</p>
				</div>
				<div class="medium-4 columns">
					<div class="medium-12 columns bluebox">
						<h4 class="textcenter vwhitefont">Our Experts</h4>
						<p class="textcenter">Our social media experts provides the knowledge and content that you will need to increase your sales. You do not need any social media experience. </p>
					</div>
					<p>&nbsp;</p>
				</div>
				<div class="medium-4 columns">
					<div class="medium-12 columns bluebox">
						<h4 class="textcenter vwhitefont">Ongoing Training</h4>
						<p class="textcenter">Konsear continually provides phone, email and webinar support. <br/>You will also have access to training documents and online tutorials.</p>
					</div>
					<p>&nbsp;</p>
				</div>
			</div>
			<h3 class="lightgrey textcenter">The Numbers</h3>
			<div class="medium-12 columns nopadding">
				<div class="medium-5 columns nopadding">
					<h3 class="lightgrey textcenter">Flat low monthly fee</h3>	
					<p>
						To publish a digital offer, you would need to spend $500 - $1000 a month minimum -- that, coupled with the time it will take to create your offer by advertisement agencies. Our 'turn - key' solution is a 'no brainer'. We provide everything you need to 'hit the ground running' for a low flat monthly fee of $19.99 (Silver plan). No Setup Fee. <br/>
						Visit <a href="plans_pricing.php">Plans & Pricing</a> section for details. 
					</p>
				</div>
				<div class="medium-2 columns nopadding">&nbsp;</div>
				<div class="medium-5 columns nopadding">	
					<h3 class="lightgrey textcenter">Publish offer anytime & from anywhere</h3>
					<p>
						We understand that you don’t need to be in front of your computer all the time in order to run your
business. We have mobile app and mobile friendly website that you can use to create and publish your customized offer anytime and your offer will be published instantly.
					</p>
				</div>
			</div>
			
			<div class="medium-12 columns nopadding">
				<div class="medium-5 columns nopadding">
					<h3 class="lightgrey textcenter">Keep 100% of your sales</h3>	
					<p>
						Since we only charge a flat low monthly fee, you collect and keep 100% of what you make! We do not
charge any transaction fees or commissions. There are no middle - men, so there are no cuts to your profits. You will not find an opportunity with this potential anywhere!  
					</p>
				</div>
				<div class="medium-2 columns nopadding">&nbsp;</div>
				<div class="medium-5 columns nopadding">	
					<h3 class="lightgrey textcenter">Unlimited potential</h3>
					<p>
						On - line coupon business is exploding! Customers are looking for deals every time and they want the deals on their mobile, so they don’t have to look for them. With Konsear platform, your opportunity is endless. The simple low monthly fee, allows you to publish unlimited offers or events with a little expense. 
					</p>
				</div>
			</div>
			
			
			<h3 class="lightgrey textcenter">Platform Features</h3>
			<div class="medium-12 columns nopadding">
				<div class="medium-5 columns nopadding">
					<h3 class="lightgrey textcenter">Customized Offers</h3>	
					<p>
						You can create your own offer online. You will be able to upload your existing offer image and describe your offer in detail. We support different offer types for e.g. Discounts, Events, Happy Hours, Wine tasting and many more...
					</p>
				</div>
				<div class="medium-2 columns nopadding">&nbsp;</div>
				<div class="medium-5 columns nopadding">	
					<h3 class="lightgrey textcenter">Anytime * Anywhere</h3>
					<p>
						Publishers can create and publish offers anytime and from any device. You can manage your offer while
relaxing on the beach or on a plane. It is easy and simple.
					</p>
				</div>
			</div>
			
			<div class="medium-12 columns nopadding">
				<div class="medium-5 columns nopadding">
					<h3 class="lightgrey textcenter">Mini Dashboard</h3>	
					<p>
						Publishers can monitor their offer results via mini dashboard. We provide the statistics that will help you better understand you advertisement campaign. You can modify your offer in real - time if you are not happy with your promotion or if you are not getting enough customers for that promo.
					</p>
				</div>
				<div class="medium-2 columns nopadding">&nbsp;</div>
				<div class="medium-5 columns nopadding">	
					<h3 class="lightgrey textcenter">Fast renewal</h3>
					<p>
						Every offer has start and expiry date. Konsear provide the quickest and easiest way to renew your offer. If your offer is doing well in the market, just change your expiry date and new offer will be created for you to publish.
					</p>
				</div>
			</div>
			
			<div class="medium-12 columns nopadding">
				<div class="medium-5 columns nopadding">
					<h3 class="lightgrey textcenter">Integration with Groupon & Living Social</h3>	
					<p>
						We are planning to integrate some of the offers originated by Groupons and Living Social. So if you have spent your hard earned money to advertise on these sites, we will publish those offers as well on our site and on our mobile app. This way your prospect customers will not miss out any offers published by you.
					</p>
				</div>
				<div class="medium-2 columns nopadding">&nbsp;</div>
				<div class="medium-5 columns nopadding">	
					<h3 class="lightgrey textcenter">Easy access to offers and events</h3>
					<p>
						Konsear is all about simplicity. We display your offers on our website and on our mobile app as soon as you publish them. Your prospect customers will get real - time notifications of your offers.
					</p>
				</div>
			</div>
			
			<div class="medium-12 columns nopadding">
				<div class="medium-5 columns nopadding">
					<h3 class="lightgrey textcenter">Social Media</h3>	
					<p>
						As per our study, about 75% of the smartphone owners check their social media 3 - 4 times a day. Konsear Social media experts push your published offers on most of the social networking sites on a daily basis. Konsear app also
has an ability to share an offer on social media sites.
					</p>
				</div>
				<div class="medium-2 columns nopadding">&nbsp;</div>
				<div class="medium-5 columns nopadding">	
					<h3 class="lightgrey textcenter">Get Notifications</h3>
					<p>
						Our Mobile app sends notifications to your customers when a new offers is published by you, this way they will not miss any new or changed offer.
					</p>
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
