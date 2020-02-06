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
	if(isset($_POST['submit']))
	{
			
		$opass	= ($_POST['opass']);
		$npass 	= ($_POST['npass']);
		$rpass 	= ($_POST['rpass']);
		
		
			$query = sprintf("SELECT PublisherPassword FROM %s%s WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $pubid);
						
			$row = $db->getRow($query); 
			
			if(isset($row))
			{
				
				$pass = decrypt($row['PublisherPassword']);
			}
			
		if(isEmpty($opass)) 
		{
			$message .= "Please fill Old Password";
		}
		elseif(isEmpty($npass)) 
		{
			$message .= "Please fill New Password";
		}
		elseif(isEmpty($rpass)) 
		{
			$message .= "Please fill Repeat Password";
		}
		elseif($npass != $rpass) 
		{
			$message .= "New Password and Repeat Password must be same";
		}
		elseif($pass != $opass)
		{
			$message = "Old Password was not same";
		}
		
		if($message == "")
		{
			$npass = encrypt2way($npass);
			$query = sprintf("UPDATE %s%s SET PublisherPassword = '%s' WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $npass, $pubid);
						
			$row = $db->updateRow($query);
			$message = "Password changed successfully";
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
	
	<div class="row">
		<div class="hideinmobile"><?php include('leftbar.php'); ?></div>
	    <div class="medium-6 columns">
			 <form name="register" id="register" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size"  >
				<div class="medium-12 columns bottomspace">
					
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<h3 class="lightgrey">Change Password</h3>	
					<div class="medium-5 columns">
						<label class="inline">Old Password</label>
					</div>
					<div class="medium-7 columns">
						<input type="password" name="opass" id="opass" value=""><span class="vrequire">*</span>
					</div>	
					<div class="medium-5 columns">
						<label class="inline">New Password</label>
					</div>
					<div class="medium-7 columns">
						<input type="password" name="npass" id="npass" value=""><span class="vrequire">*</span>
					</div>	
					<div class="medium-5 columns">
						<label class="inline">Repeat Password</label>
					</div>
					<div class="medium-7 columns">
						<input type="password" name="rpass" id="rpass" value=""><span class="vrequire">*</span>
					</div>
					<div class="medium-7 columns">
						<div align="center">
							<input type="submit" name="submit" value="Update" class="tiny button radius">
						</div>
					</div>
				</div>
			</form>
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