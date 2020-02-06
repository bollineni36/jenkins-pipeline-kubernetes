<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		require_once("includes/SimpleImage.php");

	
	
	if(!isset($_SESSION['pubid']))
	{
		redirectPage('login.php');
	}
	else
	{
		$pubid = $_SESSION['pubid'];
	}
	$message = "";
	$path = "";
	
	
	$db = new VDatabase(true);
	if(isset($_POST['submit']))
	{
		$oid = $_SESSION['oid'];	
		$aname		= ($_POST['aname']);
		$oname 		= ($_POST['oname']);
		$desc 		= ($_POST['desc']);
		$catid		= ($_POST['catid']);
		$subcatid	= ($_POST['subcatid']);
		$rprice		= ($_POST['rprice']);
		$oprice		= ($_POST['oprice']);
		$discount	= ($_POST['discount']);
		$startdate	= ($_POST['startdate']);
		$enddate	= ($_POST['enddate']);
		$oldstartdate = ($_POST['oldstartdate']);
		$oldenddate	= ($_POST['oldenddate']);
		$status		= ($_POST['status']);
		$stat		= ($_POST['stat']);
			
		if(isEmpty($oname)) 
		{
			$message .= "Please fill Offer Name";
		} 
		elseif(isEmpty($desc)) 
		{
			$message .= "Please fill Description";
		}
		elseif(isEmpty($subcatid)) 
		{
			$message .= "Please select Sub Category";
		}
		elseif(isEmpty($rprice)) 
		{
			$message .= "Please fill Regular Price";
		} 
		elseif(isEmpty($oprice)) 
		{
			$message .= "Please fill Offer Price";
		}
		elseif(isEmpty($discount)) 
		{
			$message .= "Please fill Discount percentage";
		}
		elseif(isEmpty($startdate)) 
		{
			$message .= "Please select Offer Start Date";
		}
		elseif(isEmpty($enddate)) 
		{
			$message .= "Please select Offer End Date";
		}
		
		if($message == "")
		{
			$image = "";
			$startdate = convertDateToDBFormat($startdate);
			$enddate = convertDateToDBFormat($enddate);
			
			
				//To get publisher details
				$query = sprintf("SELECT * FROM  %s%s WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $pubid);
								
				$row = $db->getRow($query);
				
				$count = 0;
				//To get Accounts list
				$query1 = sprintf("SELECT * FROM  %s%s WHERE PublisherId = '%s' AND OfferActiveFlag='Active'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $pubid);
								
				$row1 = $db->getRow($query1); 
				$count = $db->noOfRows($query1);
				
				$plan	= $row['PublisherPlanId'];
				$publastdate = toUSFormat($row['PublisherEndDate'], FALSE);
				$firstdate = toUSFormat($row['PublisherStartDate'], FALSE);
				
				if($stat == "Inactive" && $status == "Active")
				{
					$count++;
					
					
					if($count == 2 && $plan == "1")
					{
						$_SESSION['errormsg'] = "For your plan you can have only one active offer";
						redirectPage('manage_offers.php');
					}
									
					if($plan == 2)
					{
						$query3 = sprintf("SELECT * FROM %s%s WHERE ( (OfferStartDate BETWEEN '%s' AND '%s') OR (OfferEndDate BETWEEN '%s' AND '%s') OR (OfferStartDate <'%s' AND OfferEndDate >'%s')) AND (PublisherId='%s') AND OfferActiveFlag = 'Active'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $startdate, $enddate, $startdate, $enddate, $startdate, $enddate, $pubid);
						
						$count = $db->noOfRows($query3);	
						
						if($count > 0)
						{
							$_SESSION['errormsg'] = "For your plan you can have only one active offer per day";
							redirectPage('manage_offers.php');
						}
					}
				}
				if($plan > 1)
				{
					if($plan>2)
					{
						if($publastdate < $enddate)
						{
							$status = 'Inactive';
						}	
					}
					if($plan == 2)
					{
					//	echo $oldstartdate." ".$oldenddate." ".$startdate." ".$enddate;
						if($oldenddate != $enddate || $oldstartdate != $startdate)
						{
							$days = (strtotime($enddate) - strtotime($startdate))/(60*60*24);
							$olddays = (strtotime($oldenddate) - strtotime($oldstartdate))/(60*60*24);
							//	echo $days;
							//	echo $olddays;
							if($days > $olddays)
							{
								if(strtotime($oldstartdate) < strtotime(date('Y-m-d')))
								{
									$newdays = $days - $olddays;
									$status = 'Inactive';
								}
								else
								{
									 $newdays = $days - $olddays;
									 $status = 'Inactive';
								}
							}
							else
							{
								 $status = 'Active';
							}
						}
					}
					//echo $status;
				}
			
				$query = sprintf("UPDATE %s%s SET AccountId = '%s', CategoryId = '%s', SubCategoryId = '%s', OfferName = '%s',OfferDesc = '%s', OfferPercent = '%s', RegPrice = '%s', OfferPrice = '%s', OfferStartDate ='%s', OfferEndDate = '%s', OfferActiveFlag = '%s' WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $aname, $catid, $subcatid, $oname, $desc, $discount, $rprice, $oprice, $startdate, $enddate, $status, $oid);
							
				$row = $db->updateRow($query);
				
				
				if(isset($_FILES['file']) && !empty($_FILES['file']['name'])) 
				{
					$file_exts = array("jpg", "jpeg", "gif", "png");
				//	$upload_exts = end(explode(".", $_FILES["file"]["name"]));
					if ((($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/png")
					|| ($_FILES["file"]["type"] == "image/pjpeg"))
					&& ($_FILES["file"]["size"] < 5000000))
					{
						if ($_FILES["file"]["error"] > 0)
						{
						$message = "Return Code: " . $_FILES["file"]["error"] . "<br>";
						}
						else
						{
								$filetype = $_FILES["file"]["type"];
								$filetype = str_replace("image/","",$filetype);
								
							    $target_folder = 'uploads/offers/'.$oid.'/'; 
								
								if (!file_exists($target_folder)) {
								    mkdir($target_folder, 0777, true);
								}
							//	mkdir($target_folder);
								
							    $upload_image = $target_folder.basename($_FILES['file']['name']);

							    $thumb = $target_folder."thumb.".$filetype;
								$full = $target_folder."full.".$filetype;

							    $newwidth = "240";
							    $newheight = "180";

							    if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_image)) 
							    {
									smart_resize_image($upload_image, $newwidth, $newheight, false, $thumb, false, false, 100);
									rename($upload_image, $full);
									
									$query = sprintf("UPDATE %s%s SET OfferImage = '%s' WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $thumb, $oid);
								
									$row = $db->updateRow($query);
							    }
						}
						
						
					}
					else
					{
						$message = "Invalid file";
					}
				}
				//To retrieve offer details
						$query = sprintf("SELECT * FROM %s%s WHERE PublisherOfferId = '%s' AND PublisherId='%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $oid, $pubid);
						
						$row = $db->getRow($query); 
						
						if(isset($row))
						{
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
						
				//To redirect it to paypal
				if($status == "Inactive")
				{
						if($publastdate < $firstdate)
						{
							$firstdate = date('Y-m-d');//To change PublisherStartDate
						}
						//echo $days;
						if($plan == 2)
						{
							$planname = SILVER_PLAN;
							$planprice = SILVER_PRICE * $newdays;
														
							$lastdate = $publastdate;
						}
						elseif($plan == 3)
						{
							$planname = GOLD_PLAN;
							$planprice = GOLD_PRICE;
							$lastdate = date('Y-m-d H:i:s', strtotime("+30 days"));
						}
						elseif($plan == 4)
						{
							$planname = PLATINUM_PLAN;
							$planprice = PLATINUM_PRICE;
							$lastdate = date('Y-m-d H:i:s', strtotime("+365 days"));
						}
						
						$_SESSION['amt'] = $planprice;
						$_SESSION['od'] = $oid;
						$_SESSION['firstdate'] = $firstdate;
						$_SESSION['lastdate'] = $lastdate;
						$success = 'Yes';
				}
		}
		
	}
	else
	{
		if(isset($_GET['oid']))
		{
			$oid = $_GET['oid'];	
			$_SESSION['oid'] = $oid;
		}
		else
		{
			if($_SESSION['oid'] < 1)
			{
				redirectPage('manage_offers.php');
			}
		}
		
		$query = sprintf("SELECT * FROM %s%s WHERE PublisherOfferId = '%s' AND PublisherId='%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $oid, $pubid);
						
		$row = $db->getRow($query); 
		
		if(isset($row))
		{
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
			redirectPage('manage_offers.php');
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
	
	<link rel="stylesheet" href="datepick/jquery-ui.css">
	<script src="datepick/jquery-1.9.1.js"></script>
	<script src="datepick/jquery-ui.js"></script>
	<script>
		$(function() {
				$( "#startdate" ).datepicker({
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					minDate: 0,
					dateFormat: "mm/dd/yy",
					onSelect: function( selectedDate ) {
						$( "#enddate" ).datepicker( "option", "minDate", selectedDate );
					}
				});
				$( "#enddate" ).datepicker({
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					minDate: 0,
					maxDate: +30,
					dateFormat: "mm/dd/yy",
					onSelect: function( selectedDate ) {
						$( "#startdate" ).datepicker( "option", "maxDate", selectedDate );
					}
				});
			});
	</script>
	<script>
	
		function catlist()
		{
			var aname = $('#aname').val();
		//	alert(aname)
			$.ajax({	
				url: "<?php echo BASE_URL;?>dynamicsubcat.php", //The url where the server req would we made.
				async: false, 
				type: "POST", //The type which you want to use: GET/POST
				data: "aname="+aname, //The variables which are going.
				dataType: "html", //Return data type (what we expect).
				success: function(response) {
					$('.subcatdiv').html(response);
				}
			});
		}
	</script>
  </head>
  <body>
	
  	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row">
		<?php include('leftbar.php'); ?>
	    <div class="medium-6 columns">
			 <form name="register" id="register" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size" enctype="multipart/form-data" >
				<div class="medium-12 columns bottomspace">
					<?if($path != "") { ?><div class="textcenter"><img src="<?php echo $path?>"></div><?php } ?>
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<h3 class="lightgrey">Update Offer</h3>
					<div class="medium-5 columns">
						<label class="inline">Business Name</label>
					</div>
					<div class="medium-7 columns">
						<select name="aname" id="aname" onchange="catlist()">
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
						<input type="text" name="oname" id="oname" value="<?php if(isset($oname)) echo $oname; ?>"><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Description</label>
					</div>
					<div class="medium-7 columns">
						<textarea name="desc" id="desc"><?php if(isset($desc)) echo $desc; ?></textarea><span class="vrequire">*</span>
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
							
							<select name="subcatid" id="subcatid">
							<option value="">Select Sub Category</option>
							<?
								
								$db = new VDatabase(true);
								$query = sprintf(" SELECT id.InterestDetailId, id.InterestDetailName FROM %s%s id, %s%s a WHERE InterestDetailActiveFlag = 'Active' AND a.InterestHeaderId = id.InterestHeaderId AND a.PublisherId = %s AND a.AccountId = %s", DB_PREFIX, INTERESTDETAILS_TABLE, DB_PREFIX, ACCOUNT_TABLE, $pubid, $acid);
				//echo $query;
								echo fillDropdown($query, (isset($subcatid) ? $subcatid : ''));
								
								
							?></select><span class="vrequire">*</span>
							
						</div>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Regular Price</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="rprice" id="rprice" value="<?php if(isset($rprice)) echo $rprice; ?>" placeholder="Eg: $20.99"><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Offer Price</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="oprice" id="oprice" value="<?php if(isset($oprice)) echo $oprice; ?>" placeholder="Eg: $15.99"><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Discount (%)</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="discount" id="discount" value="<?php if(isset($discount)) echo $discount; ?>" placeholder="Eg: 15"><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Start Date</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="startdate" id="startdate" value="<?php if(isset($startdate)) echo $startdate; ?>"><span class="vrequire">*</span>
					</div>
					<input type="hidden" name="stat" value="<?php echo $status?>"/>
					<div class="medium-5 columns">
						<label class="inline">End Date</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="enddate" id="enddate" value="<?php if(isset($enddate)) echo $enddate; ?>"><span class="vrequire">*</span>
					</div>
					<input type="hidden" name="oldstartdate" value="<?php echo $startdate?>">
					<input type="hidden" name="oldenddate" value="<?php echo $enddate?>">
					<div class="medium-5 columns">
						<label class="inline">Status</label>
					</div>
					<div class="medium-7 columns">
						<div class="medium-6 columns">
							<label class="inline"><input type="radio" name="status" id="status" value="Active" <?php if($status=='Active') echo "checked='checked'"; ?>> Active</label>
						</div>
						<div class="medium-6 columns nopadding">
							<label class="inline"><input type="radio" name="status" id="status" value="Inactive" <?php if($status=='Inactive') echo "checked='checked'"; ?>> Inactive<span class="vrequire">*</span></label>
						</div>
					</div>	
					
					<div class="medium-5 columns">
						<label class="inline">Offer Image</label>
					</div>
					<div class="medium-7 columns">
						<input type="file" name="file" id="file" value="">
					</div>
					<div class="medium-12 columns"><p style="padding-top: 20px;"></p></div>
					<div class="medium-7 columns">
						<div align="center">
							<input type="submit" name="submit" value="Update" class="tiny button radius">
						</div>
					</div>
				</div>
			</form>
		</div> 
		<?php include('rightbar.php'); ?>
	</div>
 

  <!-- Footer -->
	<?php include('footer1.php'); ?>

    <!--<script src="js/jquery-1.8.2.min.js"></script>-->
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
  </body>
</html>

<?php
if(isset($success))
{
	if($success == "Yes")
		echo '
<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypalpayment" name="paypalpayment">
<input value="_xclick" type="hidden" name="cmd">
<input value="payusage@gmail.com" type="hidden" name="business">
<input value="'.$planname.'" type="hidden" name="item_name">
<input type="hidden" name="rm" value="2" />
<input value="'.$planprice.'" type="hidden" name="amount">
<input value="1" type="hidden" name="no_note">
<input value="USD" type="hidden" name="currency_code">
<input type="hidden" name="cbt" value="Return to Konsear App" />
<input type="hidden" name="return" value="'.BASE_URL.'pay_createoffer.php?amt='.$planprice.'">
<input type="hidden" name="cancel_return" value="'.BASE_URL.'createoffer.php">
<input type="image" src="https://www.paypalobjects.com/en_GB/SG/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal � The safer, easier way to pay online." id="paysubmit" style="display: none;">
</form>';

}

?>