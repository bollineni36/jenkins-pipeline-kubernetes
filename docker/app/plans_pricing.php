<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		
		
	if(isset($_SESSION['pubid']))
	{
		$db = new VDatabase(true);
		
		$pubid = $_SESSION['pubid'];
		$query = sprintf("SELECT * FROM  %s%s WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $pubid);
								
		$row = $db->getRow($query);
		
		$plan	= $row['PublisherPlanId'];
		$publastdate = $row['PublisherEndDate'];
		$firstdate = $row['PublisherStartDate'];
		
		$today = date('Y-m-d');
					
		if(isset($_POST['upgrade2']))
		{
			
			$plansname = SILVER_PLAN;
			$planprice = SILVER_PRICE;
			
			$firstdate = date('Y-m-d');	
			
			//if($publastdate > $firstdate)
				//$firstdate = $publastdate;		
			
			//$lastdate = date('Y-m-d H:i:s', strtotime("+1 day"));
			$lastdate = date('Y-m-d H:i:s', strtotime("-1 day"));
			
			$_SESSION['amt'] = $planprice;
			$_SESSION['planname'] = $plansname;
			$_SESSION['firstdate'] = $firstdate;
			$_SESSION['lastdate'] = $lastdate;
			$success = 'Yes';
		}
		if(isset($_POST['upgrade3']))
		{
			$plansname = GOLD_PLAN;
			$planprice = GOLD_PRICE;
			$firstdate = date('Y-m-d');	
			
			if($publastdate > $firstdate)
				$firstdate = $publastdate;			
			
			$lastdate = date('Y-m-d H:i:s', strtotime("+30 days"));
			
			 $_SESSION['amt'] = $planprice;
			 $_SESSION['planname'] = $plansname;
			 $_SESSION['firstdate'] = $firstdate;
			 $_SESSION['lastdate'] = $lastdate;
			$success = 'Yes';
		}
		if(isset($_POST['upgrade4']))
		{
			$plansname = PLATINUM_PLAN;
			$planprice = PLATINUM_PRICE;
			$firstdate = date('Y-m-d');	
			if($publastdate > $firstdate)
				$firstdate = $publastdate;			
			
			$lastdate = date('Y-m-d H:i:s', strtotime("+365 days"));
			
			$_SESSION['amt'] = $planprice;
			$_SESSION['planname'] = $plansname;
			$_SESSION['firstdate'] = $firstdate;
			$_SESSION['lastdate'] = $lastdate;
			$success = 'Yes';
		}
		
		 
		$db->closeConnection();
	}
	$h1tag = "App Plans and Pricing";
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsear Local Offers | Plans and Pricing</title>
    
    <meta name="description" content="Your City. Your Deals and Events. Welcome to Konsear Local Offers! Konsear Local Offers brings you the best local deals and events in your community." /> 
	<meta name="keywords" content="local offers, coupons, daily deals, groupon, living social, deals, local events, deal of the day, half off deals, half off specials, online coupons, happy hour, wine tasting" />
	<?php include('includes.php'); ?>
	
	<!--<link rel="stylesheet" href="css/style1.css" type="text/css" media="all">-->
	<script>
		function reply_click(clicked_id)
		{
		    alert(clicked_id);
		}
	</script>
	
	<style>
		 #mydiv {  
		    position:fixed;
		    top:0;
		    left:0;
		    width:100%;
		    height:100%;
		    z-index:1000;
		    background-color:grey;
		    opacity: .8;
		 }

		.ajax-loader {
		    position: fixed;
		    left: 50%;
		    top: 30%;
		    margin-left: -32px; /* -1 * image width / 2 */
		    margin-top: -32px;  /* -1 * image height / 2 */
		    display: block;     
		}

		
	</style>
  </head>
  <body>
	
  	<?php
		if(isset($success))
		{
			if($success == "Yes")
			{
				$_SESSION['paypalpage'] = "pay_createoffer.php";
					echo '<div id="mydiv">
				    	<img src="images/ajax-loader.gif" class="ajax-loader">
					</div>';
			}
		}
	?>
<?php include('header.php'); ?>

	
	<?php include('menu1.php'); ?>
	<div class="row">
		<!-- <div class="medium-3 columns">
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
				<p class="toppicks"><img src="images/kid.png"></p>
			</div>
			
			<div class="vbottomspace">
				<p class="heading">Top Picks</p>
				<p class="toppicks"><img src="images/kid.png"></p>
			</div>
		</div>-->
	    <div class="medium-12 columns">
	    
			<div align="center">
			<!--<div class="vbottomspace">
				<h3 class="lightgrey">How it works?</h3>
				<iframe width="640" height="360" src="//www.youtube.com/embed/lu3JQfu_vTc" frameborder="0" allowfullscreen></iframe>
			</div>-->
			<h3 class="lightgrey">Plans & Packages</h3>
			<div style="padding: 2em 0">
			<!-- DC Pricing Tables:2 Start -->
			<?php 
		   		if(!isset($_SESSION['pubid']))
		   			$blocks = "pricing_five";
			    else	
			    	$blocks = "pricing_four";
			?>
			<form name="upgrade" action="" method="POST">
			  <div class="tsc_pricingtable02 <?php echo $blocks?>">
			    <ul class="pricing_column_first">
			      <li class="pricing_header1"></li>
			      <li class="pricing_header2"><span>Choose a Plan</span></li>
			      <li class="odd"> <a class="mytooltip" href="#">Sub Accounts <span>Number of Sub-Accounts that can be created by an Account Holder. <br/>&#013;For e.g. Business with different branches in different Zip codes or cities. <br/>&#013;Business is the Account Holder.</span> </a> </li>
			      <li class="even"> <a class="mytooltip" href="#">Offer per Day <span>Number of Offers that can be published by each Account.</span> </a> </li>
			      <li class="odd"><a class="mytooltip" href="#">Edits <span>Number of Edits that can be done for a Published Offer.</span> </a></li>
			      <li class="even"> <a class="mytooltip" href="#">Limit <span>Geographical Spread per Offer. <br/>For e.g. Starter can publish offers for one selected zipcode. Silver can publish offers for all the zipcodes in one selected State.</span> </a> </li>
			      <li class="odd"><a class="mytooltip" href="#">Share on Social Media <span>Share the published offer on Social Media sites.</span> </a></li>
			      <li class="even"><a class="mytooltip" href="#">Customer Reach <span>Published Offers will reach to all Subscribers of that Category. <br/>For e.g. Offers for "Happy Hour" will reach to only those subscribers who opted for "Happy Hour" for that zipcode.</span> </a></li>
			      <li class="odd"> <a class="mytooltip" href="#">Mini Dashboard <span>Mini Dashboard will display the report for your published offers by each sub-account. <br/>This Dashboard will include the following:  <br/>* Number of interested Subscribers for your published offers.  <br/>* Number of interested Subscribers who have tagged your offer.  <br/>* Number of Total Subscriber by Location.</span> </a> </li>
			      <li class="pricing_footer"></li>
			    </ul>
			    <div class="pricing_hover_area">
			    <?php 
			    	if(!isset($_SESSION['pubid']))
					{
				?>
			      <ul class="pricing_column red">
			        <li class="pricing_header1">STARTER</li>
			        <li class="pricing_header2">Free <span>(90-days Trial)</span></li>
			        <li class="odd">No</li>
			        <li class="even">One</li>
			        <li class="odd">No</li>
			        <li class="even">Single Zip Code</li>
			        <li class="odd">Yes</li>
			        <li class="even">Single Zip Code</li>
			        <li class="odd">Single Zip Code</li>
			        <li class="pricing_footer"><a href="register.php?plan=1" class="tsc_buttons2 black">Sign Up</a></li>
			      </ul>
			      <?php } ?>
			      <ul class="pricing_column red">
			        <li class="pricing_header1">SILVER</li>
			        <li class="pricing_header2">$9.99 <span>/month</span></li>
			        <li class="odd">One</li>
			        <li class="even">3</li>
			        <li class="odd">One</li>
			        <li class="even">Single City</li>
			        <li class="odd">Yes</li>
			        <li class="even">Single City</li>
			        <li class="odd">No</li>
			        <li class="pricing_footer">
			        <?php 
			    		if(!isset($_SESSION['pubid']))
						{
					?>
			        	<a href="register.php?plan=2" class="tsc_buttons2 black">Sign Up</a>
			        <?php } else { ?>
			        	<input type="submit" style="border: none;" class="tsc_buttons2 black" name="upgrade2" value="Upgrade" id="2">
			        <?php } ?>
			        </li>
			      </ul>
			      <ul class="pricing_column blue">
			        <li class="pricing_header1">GOLD (Most Popular)</li>
			        <li class="pricing_header2">$19.99 <span>/month</span></li>
			        <li class="odd">3</li>
			        <li class="even">3 per Account</li>
			        <li class="odd">3</li>
			        <li class="even">Single State</li>
			        <li class="odd">Yes</li>
			        <li class="even">Single State</li>
			        <li class="odd">Available on Request</span></li>
			        <li class="pricing_footer">
			         <?php 
			    		if(!isset($_SESSION['pubid']))
						{
					?>
			        	<a href="register.php?plan=3" class="tsc_buttons2 black">Sign Up</a>
			        <?php } else { ?>
			        	<input type="submit" style="border: none;" class="tsc_buttons2 black" name="upgrade3" value="Upgrade" id="3">
			        <?php } ?>
			       </li>
			      </ul>
			      <ul class="pricing_column red">
			        <li class="pricing_header1">PLATINUM</li>
			        <li class="pricing_header2">$39.99 <span>/month</span></li>
			        <li class="odd">Unlimited</li>
			        <li class="even">Unlimited</li>
			        <li class="odd">Unlimited</li>
			        <li class="even">Nationwide</li>
			        <li class="odd">Yes</li>
			        <li class="even">Unlimited</li>
			        <li class="odd">Direct Access</li>
			        <li class="pricing_footer">
			         <?php 
			    		if(!isset($_SESSION['pubid']))
						{
					?>
			        	<a href="register.php?plan=4" class="tsc_buttons2 black">Sign Up</a>
			        <?php } else { ?>
			        	<input type="submit" style="border: none;" class="tsc_buttons2 black" name="upgrade4" value="Upgrade" id="4">
			        <?php } ?>
			        </li>
			      </ul>
			    </div>
			  </div>
			  </form>
<!-- DC Pricing Tables:2 End -->
<!--<div class="tsc_clear"></div>--> <!-- line break/clear line -->
				<div class="clearfix"></div>
			</div> 
			<!--<form name="upgrade" action="" method="POST">
			 <table class="table1">
			                <thead>
								<?php if(!isset($_SESSION['pubid']))
								{
									echo '<tr>
				                        <th></th>
				                        <td class="textcenter" style="padding: 0 0 10px;"><a href="register.php?plan=1" class="signup" onclick="callme(this)">Sign up</a></td>
				                        <td class="textcenter" style="padding: 0 0 10px;"><a href="register.php?plan=2" class="signup">Sign up</a></td>
				                        <td class="textcenter" style="padding: 0 0 10px;"><a href="register.php?plan=3" class="signup">Sign up</a></td>
				                        <td class="textcenter" style="padding: 0 0 10px;"><a href="register.php?plan=4" class="signup">Sign up</a></td>
				                    </tr>';
								}
								else
								{
									echo '<tr>
				                        <th></th>
				                        <td></td>
				                        <td><input type="submit" style="border: none;" class="signup" name="upgrade2" value="Upgrade" id="2"></td>
				                        <td><input type="submit" style="border: none;" class="signup" name="upgrade3" value="Upgrade" id="3"></td>
				                        <td><input type="submit" style="border: none;" class="signup" name="upgrade4" value="Upgrade" id="4"></td>
				                    </tr>';
								}
								 ?>
			                    <tr>
			                        <th></th>
			                        <th scope="col" abbr="STARTER">STARTER</th>
			                        <th scope="col" abbr="SILVER">SILVER</th>
			                        <th scope="col" abbr="GOLD">GOLD</th>					
			                        <th scope="col" abbr="PLATINUM">PLATINUM</th>
			                    </tr>
			                </thead>
			                <tfoot>
			                    <tr>
			                        <!--<th scope="row"><span style="font-size: 30px;">Price</span></th>-->
									<!--<td style="padding: 18px 0 0;">Price <br> <span style="font-size: 14px;">&nbsp;</span> </td>
			                        <td style="padding: 18px 0 0;">Free <br> <span style="font-size: 14px;">&nbsp;</span> </td>
			                        <td style="padding: 18px 0 0;">0.99 <br> <span style="font-size: 14px;">per Day </span> </td>
			                        <td style="padding: 18px 0 0;">4.99 <br> <span style="font-size: 14px;">per Month </span></td>
									<td style="padding: 18px 0 0;">29.99 <br> <span style="font-size: 14px;">per Year </span></td>
			                    </tr>
								
			                    
			                </tfoot>
			                <tbody>
			                    <tr>
			                        <th scope="row" title="Number of Sub-Accounts that can be created by an Account Holder. &#013;For e.g. Business with different branches in different Zip codes or cities. &#013;Business is the Account Holder."><a href="#" class="tooltips">Sub Accounts</a></th>
			                        <td>No</td>
			                        <td>One</td>
			                        <td>Unlimited</td>
									<td>Unlimited</td>
									
			                    </tr>
			                    <tr>
			                        <th scope="row" title="Number of Offers that can be published by each Account."><a href="#" class="tooltips">Offers per day</a></th>
			                        <td>One</td>
			                        <td>One</td>
			                        <td>Unlimited</td>
									<td>Unlimited</td>
			                    </tr>
			                    <tr>
			                        <th scope="row" title="Number of Edits that can be done for an Published Offer."><a href="#" title="Number of Edits that can be done for an Published Offer." class="tooltips">Edits</a></th>
			                        <td>No</td>
			                        <td>One</td>
			                        <td>Unlimited</td>
									<td>Unlimited</td>
			                    </tr>
			                    <tr>
			                        <th scope="row" title="Geographical Spread per Offer. &#013;For e.g. Starter can publish offers for one selected zipcode. &#013;Silver can publish offers for all the zipcodes in one selected State."><a href="#" class="tooltips">Limit</a></th>
			                        <td>Single Zipcode</td>
			                        <td>Single State</td>
			                        <td>Nationwide</td>
									<td>Nationwide</td>
			                    </tr>
			                    <tr>
			                        <th scope="row" title="Share the published offer on Social Media sites."><a href="#" class="tooltips">Share on Social Media</a></th>
			                        <td>Yes</td>
			                        <td>Yes</td>
			                        <td>Yes</td>
									<td>Yes</td>
			                    </tr>
			                    <tr>
			                        <th scope="row" title='Published Offers will reach to all Subscribers of that Category. &#013;For e.g. Offers for "Happy Hour" will reach to only those subscribers who opted for "Happy Hour" for that zipcode.'><a href='#' class='tooltips'>Unlimited Customer Reach</a></th>
			                        <td>Yes</td>
			                        <td>Yes</td>
			                        <td>Yes</td>
									<td>Yes</td>
			                    </tr>
								<tr>
			                        <th scope="row" title="Mini Dashboard will display the report for your published offers by each sub-account. This Dashboard will include the following: &#013;* Number of interested Subscribers for your published offers. &#013;* Number of interested Subscribers who have tagged your offer. &#013;* Number of Total Subscriber by Location."><a href="#" data-html="true" class="tooltips">Mini Dashboard</a></th>
			                        <td>Yes</td>
			                        <td>Yes</td>
			                        <td>Yes</td>
									<td>Yes</td>
			                    </tr>
			                </tbody>
			            </table>
						</form>-->
					</div>
		</div> 
		<!--<div class="medium-3 columns">
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
				<img src="images/android.png">
			</div>
		</div>	-->
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
	<script>
		$(function() {
				$('#paysubmit').click();
		});
	</script>
	<!-- DC Pricing Tables CSS -->
<link type="text/css" rel="stylesheet" href="css/tsc_pricingtables.css" />
<!-- DC Pricing Tables JS -->
<script type="text/javascript" src="js/tsc_pricingtables.js"></script>
  </body>
</html>

<?php
if(isset($success))
{
	if($success == "Yes")
	{
		//echo $plansname;
		$_SESSION['paypalpage'] = "pay_upgrade.php";
//<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypalpayment" name="paypalpayment">			
		echo '
<form method="post" action="https://www.paypal.com/cgi-bin/webscr" id="paypalpayment" name="paypalpayment">
<input value="_xclick" type="hidden" name="cmd">
<input value="order@evaltech.com" type="hidden" name="business">
<input value="'.$plansname.'" type="hidden" name="item_name">
<input type="hidden" name="rm" value="2" />
<input value="'.$planprice.'" type="hidden" name="amount">
<input value="1" type="hidden" name="no_note">
<input value="USD" type="hidden" name="currency_code">
<input type="hidden" name="cbt" value="Return to Konsear App" />
<input type="hidden" name="return" value="'.BASE_URL.'pay_createoffer.php?amt='.$planprice.'">
<input type="hidden" name="cancel_return" value="'.BASE_URL.'plans_pricing.php">
<input type="image" src="https://www.paypalobjects.com/en_GB/SG/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online." id="paysubmit" style="display: none;">
</form>';
	}

}

?><!--http://www.dreamtemplate.com/dreamcodes/documentation/pricingtables.html-->