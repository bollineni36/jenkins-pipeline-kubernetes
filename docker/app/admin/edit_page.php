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
			redirectPage('admin/manage_pages.php');
		}
		if(isset($_POST['submit']))
		{
			$pg = $_SESSION['pg'];	
			$desc	= ($_POST['desc']);
			
			$query = sprintf("UPDATE %s%s SET Description = '%s' WHERE PageId = '%s'", DB_PREFIX, PAGES_TABLE, $desc, $pg);
								
			$row = $db->updateRow($query);
			
			$message = "Page Updated successfully";
		}
		else
		{
			if(isset($_GET['pg']))
			{
				$pg = $_GET['pg'];	
				$_SESSION['pg'] = $pg;
			}
			else
			{
				if($_SESSION['pg'] < 1)
				{
					redirectPage('admin/manage_pages.php');
				}
			}
				
		}
		
		
		$query = sprintf("SELECT * FROM %s%s WHERE PageId = '%s'", DB_PREFIX, PAGES_TABLE, $pg);
						
		$row = $db->getRow($query); 
		
		if(isset($row))
		{
			$pg = $row['PageId'];
			$pagename = $row['PageName'];
			$desc 	= $row['Description'];
		}	
		else
		{
			redirectPage('admin/manage_pages.php');
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
	
	<script type="text/javascript" src="tinymce/tinymce.min.js"></script>

	<script type="text/javascript">
		tinymce.init({
		    selector: "textarea"
		 });
	</script>

  </head>
  <body>
	<?$page = "Manage_Offers";?>
	<?php include('header.php'); ?>
	
	<div class="row">
		<p>&nbsp;</p>
		<?php include('leftbar.php'); ?>
	    <div class="medium-9 columns">
			 <form name="editoffer" id="editoffer" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size" enctype="multipart/form-data" >
				<div class="medium-12 columns bottomspace">
					
					<?php if($message != "") echo "<br/><div class='alert-box success radius'>".$message."</div>"; ?>
					<h3 class="lightgrey">Edit Page - <?php echo $pagename?></h3>
					
					<div class="medium-12 columns">
						<textarea name="desc" id="desc" rows="20"><?php if(isset($desc)) echo html_entity_decode($desc); ?></textarea>
					</div>
					<div class="medium-12 columns"><p></p></div>
					<div class="medium-12 columns">
						<div align="center">
							<input type="submit" name="submit" value="Update" class="tiny button radius" style="margin-right: 10px;">
							<input type="submit" name="back" value="Back" class="tiny button radius">
						</div>
					</div>
				</div>
			</form>
		</div> 
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