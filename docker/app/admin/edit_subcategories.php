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
			redirectPage('admin/manage_categories.php');
		}
		if(isset($_POST['submit']))
		{
			$id = $_SESSION['id'];	
			$interestheader	= ($_POST['interestheader']);
			$interestdetail	= ($_POST['interestdetail']);
			$status			= ($_POST['status']);
			
			
			if(isEmpty($interestheader)) 
			{
				$message = "Please fill Interest Header";
			} 
			elseif(isEmpty($interestdetail)) 
			{
				$message = "Please fill Interest Detail";
			} 
			if($message == "")
			{
			 
				$query = sprintf("UPDATE kon_interestdetails SET InterestHeaderId = '%s', InterestDetailName = '%s', InterestDetailActiveFlag = '%s' WHERE InterestDetailId = '%s'", $interestheader, $interestdetail, $status, $id);
									
				$row = $db->updateRow($query);
			
				$query = sprintf("SELECT *, (SELECT InterestHeaderName FROM kon_interestheader WHERE kon_interestheader.InterestHeaderId=kon_interestdetails.InterestHeaderId) as InterestHeaderName FROM kon_interestdetails WHERE InterestDetailId = '%s'", $id);
								
				$row = $db->getRow($query); 
				
				if(isset($row))
				{
					$interestheader = $row['InterestHeaderId'];
					$interestdetail = $row['InterestDetailName']; 
					$status = $row['InterestDetailActiveFlag'];
				}	
				$message = "Interest Detail was changed successfully";
			}
		}
		else
		{
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];	
				$_SESSION['id'] = $id;
			}
			else
			{
				if($_SESSION['id'] < 1)
				{
					redirectPage('admin/manage_subcategories.php');
				}
			}
			
			$query = sprintf("SELECT *, (SELECT InterestHeaderName FROM kon_interestheader WHERE kon_interestheader.InterestHeaderId=kon_interestdetails.InterestHeaderId) as InterestHeaderName FROM kon_interestdetails WHERE InterestDetailId = '%s'", $id);
							
			$row = $db->getRow($query); 
			
			if(isset($row))
			{
				$interestheader = $row['InterestHeaderId'];
				$interestdetail = $row['InterestDetailName']; 
				$status = $row['InterestDetailActiveFlag'];
			}	
			else
			{
				redirectPage('admin/manage_subcategories.php');
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
	<?$page = "Manage_SubCategories";?>
	<?php include('header.php'); ?>
	
	<div class="row">
		<p>&nbsp;</p>
		<?php include('leftbar.php'); ?>
		<div class="medium-1 columns">&nbsp;</div>
	    <div class="medium-6 columns">
			 <form name="editoffer" id="editoffer" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size" enctype="multipart/form-data" >
				<div class="medium-12 columns bottomspace">
					
					<?php if($message != "") echo "<br/><div class='alert-box success radius'>".$message."</div>"; ?>
					<h3 class="lightgrey">Update Interest Detail</h3>
					
					<div class="medium-5 columns">
						<label class="inline">Interest Header</label>
					</div>
					<div class="medium-7 columns">
						<select name="interestheader" id="interestheader">
							<?
								$db = new VDatabase(true);
								
								$query2 = sprintf("SELECT InterestHeaderId, InterestHeaderName FROM %s%s", DB_PREFIX, INTERESTHEADER_TABLE);
								echo fillDropdown($query2, (isset($interestheader) ? $interestheader : ''));
								
								$db->closeConnection();
							?></select>
					
					</div>	
					<div class="medium-5 columns">
						<label class="inline">Interest Detail</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="interestdetail" id="interestdetail" value="<?php if(isset($interestdetail)) echo $interestdetail; ?>">
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

    <!--<script src="../js/jquery-1.8.2.min.js"></script>-->
    <script src="../js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>