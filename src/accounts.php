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
	
		$query = sprintf("SELECT * FROM %s%s WHERE PublisherId = '%s'", DB_PREFIX, ACCOUNT_TABLE, $pubid);
						
		$rows = $db->getRows($query); 
		
			
			
	
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
		<?php //include('leftbar.php'); ?>
		<div class="medium-1 columns">&nbsp;</div>
	    <div class="medium-10 columns">
			 <form name="register" id="register" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size" enctype="multipart/form-data" >
				<div class="medium-12 columns bottomspace">
					<?php 
						if(isset($_SESSION['errormsg'])) 
						{ 
							if($_SESSION['errormsg'] != "") 
								echo "<div class='alert-box success radius'>".$_SESSION['errormsg']."</div>"; 
						}
						
						$_SESSION['errormsg'] = "";
					 ?>
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<div class="medium-6 columns"><h3 class="lightgrey">Manage Accounts</h3></div>
					<div class="medium-6 columns nopadding">
					<?php
						if($_SESSION['planid'] != 1)
						{
					?>
							<a href="<?php echo BASE_URL;?>new_account.php"><input type="button" name="create" value="Create Account" class="tiny button radius right"></a>
					<?php
						}
					?>
						
					</div>
					<table width="100%">
						<thead>
							<tr>
								<td>Sr. No.</td>
								<td>Account Name</td>
								<td>City</td>
								<td>Zipcode</td>
								<td>Category</td>
								<td>Status</td>
								<td>Edit</td>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i = 0;
								foreach($rows as $row)
								{
									$acid 		= $row['AccountId'];
									$aname 		= $row['AccountName'];
									$zip 		= $row['AccountZipcode'];
									$city 		= $row['AccountCity'];
									$catid	 	= $row['InterestHeaderId'];
									$status 	= $row['PublisherActiveFlag'];
									$i++;
									
									$db = new VDatabase(true);
	
										$query1 = sprintf("SELECT InterestHeaderName FROM %s%s WHERE InterestHeaderId = '%s'", DB_PREFIX, INTERESTHEADER_TABLE, $catid);
														
										$row1 = $db->getRow($query1);
										
										$category = $row1['InterestHeaderName']; 
									
									$db->closeConnection();
							?>		
									
									<tr>
										<td><?php echo $i?></td>
										<td><?php echo $aname?></td>
										<td><?php echo $city?></td>
										<td><?php echo $zip?></td>
										<td><?php echo $category?></td>
										<td><?php echo $status?></td>
										<td><a href="edit_account.php?acid=<?php echo $acid?>"><img src="<?php echo BASE_URL?>images/edit.png"></a></td>
									</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</form>
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