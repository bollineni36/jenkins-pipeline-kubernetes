<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/classes/VPagination.php");
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
	
		$query = sprintf("SELECT *, (SELECT AccountName FROM %s%s a WHERE a.AccountId = o.AccountId) AS AccountName FROM %s%s o WHERE PublisherId = '%s' ORDER BY PublisherOfferId DESC", DB_PREFIX, ACCOUNT_TABLE, DB_PREFIX, PUBLISHEROFFERS_TABLE, $pubid);
						
		$pn = new Vpagination($query, MAX_ROWS_PER_PAGE, $_SERVER['QUERY_STRING']);
		
		$rows = $pn->getRows($query);
				
		$pn->closeResultSet();
		
		$minSlNo = isset($_GET['nxtsno']) ? $_GET['nxtsno'] : 0;
		
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
		
		.no-resize {
			min-width: 65px; 
		}
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
					<div class="medium-6 columns"><h3 class="lightgrey">Manage Offers</h3></div>
					<div class="medium-12 columns nopadding">
							<a href="createoffer.php" class="button tiny radius right">Create Offer</a>
					</div>
					<?php 
						$i = 0; 
						if(isset($rows)) {
					?>
					<table width="100%">
						<thead>
							<tr>
								<td>Sr. No.</td>
								<td>Offer Name</td>
								<td>Account Name</td>
								<td>Discount</td>
								<td>From Date</td>
								<td>To Date</td>
								<td>Status</td>
								<td>Edit</td>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i = 0;
								foreach($rows as $row)
								{
									$oid 		= $row['PublisherOfferId'];
									$aname 		= $row['AccountName'];
									$oname 		= $row['OfferName'];
									$disc 		= $row['OfferPercent'];
									if(is_numeric($disc))
									 	$disc = $disc.'%';
									else
										$disc = $disc;
									
									$start	 	= toUsFormat($row['OfferStartDate'],FALSE);
									$end 		= toUsFormat($row['OfferEndDate'],FALSE);
									$status 	= $row['OfferActiveFlag'];
									$i++;
									
							?>		
									
									<tr>
										<td><?php echo $i?></td>
										<td><?php echo $oname?></td>
										<td><?php echo $aname?></td>
										<td><?php echo $disc?></td>
										<td><?php echo $start?></td>
										<td><?php echo $end?></td>
										<td><?php echo $status?></td>
										<td><a href="edit_offer.php?oid=<?php echo $oid?>"><img src="<?php echo BASE_URL?>images/edit.png" class="no-resize"></a></td>
									</tr>
							<?php } echo " </table> ";
			}//for ?>

								<?php if($i == 0) { 
				
											echo "<div class='alert text-center'>No Offers Found.</div>";
											
										} else if($pn->get_total_pages() > 1) {
															
											echo "<br/>&nbsp;";				
											
											$pn->get_navigation();
										}
								
								?>
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