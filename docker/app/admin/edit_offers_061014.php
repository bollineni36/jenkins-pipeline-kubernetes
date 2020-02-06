<?php 
	require_once("../includes/start.php");
	require_once("../includes/config.php");
	require_once("../includes/tablenames.php");
	require_once("../includes/constants.php");
	require_once("../includes/classes/VDatabase.php");
	require_once("../includes/classes/VPagination.php");
	require_once("../includes/vutils.php");
	require_once("../includes/vlib.php");
	require_once("../includes/validations.php");
	
		$db = new VDatabase(true);
		$message = "";
		if(!isset($_SESSION['oid']))
		{
			redirectPage('admin/login.php');
		}
		
		if(isset($_POST['back']))
		{
			redirectPage('admin/manage_offers.php');
		}
		if(isset($_POST['submit']))
		{
			$oid = $_SESSION['od'];	
			$status	= ($_POST['status']);
			
			$query = sprintf("UPDATE %s%s SET OfferActiveFlag = '%s' WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $status, $oid);
								
			$row = $db->updateRow($query);
		
			$query = sprintf("SELECT * FROM %s%s WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $oid);
							
			$row = $db->getRow($query); 
			
			if(isset($row))
			{
				$pubid = $row['PublisherId'];
				$oname 	= $row['OfferName'];
				$desc = $row['OfferDesc'];
				$discount 	= $row['OfferPercent'];
				$rprice	= $row['RegPrice'];
				$oprice	= $row['OfferPrice'];
				$startdate = toUsFormat($row['OfferStartDate'],FALSE);
				$enddate = toUsFormat($row['OfferEndDate'],FALSE);
				$status	= $row['OfferActiveFlag'];
				$catid 	= $row['CategoryId'];
				$subcatid = $row['SubCategoryId'];
				$aname = $row['AccountId'];
				$path 	= $row['OfferImage'];
			}	
			$message = "Status changed successfully";
		}
		else
		{
			if(isset($_GET['od']))
			{
				$oid = $_GET['od'];	
				$_SESSION['od'] = $oid;
			}
			else
			{
				if($_SESSION['od'] < 1)
				{
					redirectPage('admin/manage_offers.php');
				}
			}
			
			$query = sprintf("SELECT * FROM %s%s WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $oid);
							
			$row = $db->getRow($query); 
			
			if(isset($row))
			{
				$pubid = $row['PublisherId'];
				$oname 	= $row['OfferName'];
				$desc = $row['OfferDesc'];
				$discount 	= $row['OfferPercent'];
				$rprice	= $row['RegPrice'];
				$oprice	= $row['OfferPrice'];
				$startdate = toUsFormat($row['OfferStartDate'],FALSE);
				$enddate = toUsFormat($row['OfferEndDate'],FALSE);
				$status	= $row['OfferActiveFlag'];
				$catid 	= $row['CategoryId'];
				$subcatid = $row['SubCategoryId'];
				$aname = $row['AccountId'];
				$path 	= $row['OfferImage'];
			}	
			else
			{
				redirectPage('admin/manage_offers.php');
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
    <title>Konsear.com</title>
    
    <meta name="description" content="Konsear.com" />  
	
	
	<?php include('includes.php'); ?>
	<link rel="stylesheet" href="../css/style1.css" type="text/css" media="all">
	<style>
		#change-image { font-size: 0.8em; }
		a:hover, a:focus {
			color: #000000 !important;
		}
	</style>

  </head>
  <body>
	<?$page = "Manage_Offers";?>
	<?php include('header.php'); ?>
	
	<div class="row">
		<p>&nbsp;</p>
		<?php include('leftbar.php'); ?>
		<div class="medium-1 columns">&nbsp;</div>
	    <div class="medium-6 columns">
			 <form name="editoffer" id="editoffer" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size" enctype="multipart/form-data" >
				<div class="medium-12 columns bottomspace">
					<?if($path != "") { ?><div class="textcenter"><img src="<?php echo '../'.$path?>"></div><?php } ?>
					<?php if($message != "") echo "<br/><div class='alert-box success radius'>".$message."</div>"; ?>
					<h3 class="lightgrey">Update Offer</h3>
					
					<div class="medium-5 columns">
						<label class="inline">Business Name</label>
					</div>
					<div class="medium-7 columns">
						<select name="aname" id="aname" onchange="catlist()" disabled="true">
							<?php 
								$db = new VDatabase(true);
								
								$anamequery = sprintf("SELECT AccountId, AccountName FROM %s%s WHERE PublisherId = '%s' AND PublisherActiveFlag = 'Active'", DB_PREFIX, ACCOUNT_TABLE, $pubid); 
							 	echo fillDropdown($anamequery, (isset($aname) ? $aname : '')); 
								
							?>
						</select>
					
					</div>
					
					<div class="medium-5 columns">
						<label class="inline">Offer Name</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="oname" id="oname" value="<?php if(isset($oname)) echo $oname; ?>" readonly="true">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Description</label>
					</div>
					<div class="medium-7 columns">
						<textarea name="desc" id="desc" readonly="true"><?php if(isset($desc)) echo $desc; ?></textarea>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Offer Type</label>
					</div>
					<div class="medium-7 columns">
						<div class="subcatdiv">
							<?
								$db = new VDatabase(true);
								
								$query2 = sprintf("SELECT a.InterestHeaderId, a.AccountId FROM %s%s h, %s%s a WHERE a.PublisherId = '%s' AND a.PublisherActiveFlag = 'Active' LIMIT 1", DB_PREFIX, INTERESTHEADER_TABLE, DB_PREFIX, ACCOUNT_TABLE, $pubid);
								//echo $query2;
								$headerrow = $db->getRow($query2);
								
								$ih = $headerrow['InterestHeaderId'];
								$acid = $headerrow['AccountId'];
							?>
							<input type="hidden" name="catid" value="<?php echo $ih?>">
							
							<select name="subcatid" id="subcatid" disabled="true">
							<option value="">Select Sub Category</option>
							<?
								
								$db = new VDatabase(true);
								$query = sprintf(" SELECT id.InterestDetailId, id.InterestDetailName FROM %s%s id, %s%s a WHERE InterestDetailActiveFlag = 'Active' AND a.InterestHeaderId = id.InterestHeaderId AND a.PublisherId = %s AND a.AccountId = %s", DB_PREFIX, INTERESTDETAILS_TABLE, DB_PREFIX, ACCOUNT_TABLE, $pubid, $acid);
				//echo $query;
								echo fillDropdown($query, (isset($subcatid) ? $subcatid : ''));
								
								
							?></select>
							
						</div>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Regular Price</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="rprice" id="rprice" value="<?php if(isset($rprice)) echo $rprice; ?>" placeholder="Eg: $20.99" readonly="true">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Offer Price</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="oprice" id="oprice" value="<?php if(isset($oprice)) echo $oprice; ?>" placeholder="Eg: $15.99" readonly="true">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Discount (%)</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="discount" id="discount" value="<?php if(isset($discount)) echo $discount; ?>" placeholder="Eg: 15" readonly="true">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Start Date</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="startdate" id="startdate" value="<?php if(isset($startdate)) echo $startdate; ?>" readonly="true">
					</div>
					
					<div class="medium-5 columns">
						<label class="inline">End Date</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="enddate" id="enddate" value="<?php if(isset($enddate)) echo $enddate; ?>" readonly="true">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Status</label>
					</div>
					<div class="medium-7 columns">
						<div class="medium-6 columns">
							<label class="inline"><input type="radio" name="status" id="status" value="Active" <?php if($status=='Active') echo "checked='checked'"; ?>> Active</label>
						</div>
						<div class="medium-6 columns nopadding">
							<label class="inline"><input type="radio" name="status" id="status" value="Inactive" <?php if($status=='Inactive') echo "checked='checked'"; ?>> Inactive</label>
						</div>
					</div>	
					
					<div class="medium-12 columns"><p></p></div>
					<div class="medium-7 columns">
						<div align="center">
							<input type="submit" name="submit" value="Update" class="tiny button radius" style="margin-right: 10px;">
							<input type="submit" name="back" value="Back" class="tiny button radius">
						</div>
					</div>
				</div>
			</form>
		</div> 
		<div class="medium-2 columns">&nbsp;</div>
		<div class="medium-12 columns"><p><br/></p></div>
	</div>
 

  <!-- Footer -->
	<?php include('footer1.php'); ?>

    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="../js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>