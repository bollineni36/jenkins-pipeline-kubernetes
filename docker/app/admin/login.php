<?php 
	require_once("../includes/start.php");
	require_once("../includes/config.php");
	require_once("../includes/tablenames.php");
	require_once("../includes/constants.php");
	require_once("../includes/classes/VDatabase.php");
	require_once("../includes/vutils.php");
	require_once("../includes/vlib.php");
	require_once("../includes/validations.php");
	
		$db = new VDatabase(true);
		$message = "";
		if(isset($_SESSION['oid']))
		{
			redirectPage('admin/manage_offers.php');
		}
		if(isset($_POST['submit']))
		{
			$email 		= ($_POST['email']);
			$password 	= ($_POST['password']);
			
			if(isEmpty($email)) 
			{

				$message = "Please Enter Email Id";
							
			}
			elseif(isEmpty($password)) 
			{
			
				$message = "Please Enter Password";
			
			}

			if($message == ""){
							
				
				$query = sprintf("SELECT OwnerId, OwnerName, OwnerPassword FROM %s%s WHERE OwnerEmailId = '%s' AND OwnerActiveFlag='Active'", DB_PREFIX, OWNER_TABLE, $email);
										
				$row = $db->getRow($query);
			  	
				
				if(isset($row) && (decrypt($row['OwnerPassword']) == $password)) {
					
				
						$_SESSION['oid'] = $row['OwnerId'];
						
						$_SESSION['oname'] = $row['OwnerName'];
						
						redirectPage('admin/manage_offers.php');
						
				}
				else
				{
					
					$message = "Invalid EmailId/Password. ";

				} 
				
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
	</style>

  </head>
  <body>
	
  
	<?php include('header.php'); ?>
	
	<div class="row">
		<?php //include('leftbar.php'); ?>
		<p><br/><br/><br/></p>
		<div class="medium-3 columns">&nbsp;</div>
	    <div class="medium-6 columns">
			 <form name="login" id="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size">
				<div class="medium-12 columns bottomspace" style="border: 1px solid #ffffff; border-radius: 10px;">
					
					
					<h3 class="lightgrey">Login Form</h3>
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<br/>
					<div class="medium-5 columns">
						<label class="inline">Email</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Password</label>
					</div>
					<div class="medium-7 columns">
						<input type="password" name="password" id="password" value="">
					</div>
					<div class="medium-5 columns">&nbsp;</div>
					<div class="medium-7 columns">
						<div align="center">
							<input type="submit" name="submit" value="Login" class="tiny button radius">
						</div>
					</div>
					<div class="medium-5 columns">&nbsp;</div>
					<div class="medium-7 columne">
						<p class="textcenter"><a href="forgot_password.php">Forgot Password</a></p>
					</div>
				</div>
			</form>
		</div> 
		<div class="medium-3 columns">&nbsp;</div>
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