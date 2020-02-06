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
		
		$query = sprintf("SELECT *, (SELECT InterestHeaderName FROM kon_interestheader WHERE kon_interestheader.InterestHeaderId=kon_interestdetails.InterestHeaderId) as InterestHeaderName FROM kon_interestdetails");
				
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
	    <div class="medium-9 columns">
			 <form name="login" id="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size">
				<div class="medium-12 columns bottomspace">
					
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<?php if($message != "") echo "<br/><div class='alert-box success radius'>".$message."</div>"; ?>
					<div class="medium-6 columns nopadding"><h3 class="lightgrey">Manage Interest Details</h3></div>
					<div class="medium-6 columns nopadding">
						<a href="new_subcategory.php"><input type="button" name="create" value="Create Interest Detail" class="tiny button radius right"></a>
					</div>
					
					<?php 
						if(isset($_GET['nxtsno']))
							$i = $_GET['nxtsno']; 
						else
							$i = 0;
						if(isset($rows)) {
					?>
					<table>
						<tr>
							<td>Sr. No.</td>
							<td>Interest Header</td>
							<td>Interest Detail</td>
							<td>Status</td>
							<td>Edit</td>
						</tr>
						<?php
							foreach($rows as $row) {
								++$i;
							?>
								<tr> 
									<td><?php echo $i; ?></td>
									<td><?php echo $row['InterestHeaderName']; ?></td>
									<td><?php echo $row['InterestDetailName']; ?></td>
									<td><?php echo $row['InterestDetailActiveFlag']; ?></td>
									<td><a href='edit_subcategories.php?id=<?php echo $row['InterestDetailId']; ?>'>View/Edit</a></td>
								</tr> 			
		
			<?php } echo " </table> ";
			}//for ?>

								<?php if($i == 0) { 
				
											echo "<div class='alert text-center'>Interest Headers not Found.</div>";
											
										} else if($pn->get_total_pages() > 1) {
															
											echo "<br/>&nbsp;";				
											
											$pn->get_navigation();
										}
								
								?>
					</table>
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