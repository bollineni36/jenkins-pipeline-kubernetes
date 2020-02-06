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
		if(isset($_POST['submit']))
		{
			$email 		= ($_POST['email']);
			
			if(isEmpty($email)) 
			{

				$message = "Please Enter Email Id";
							
			}

			if($message == ""){
							
				
				$query = sprintf("SELECT OwnerId, OwnerName, OwnerPassword FROM %s%s WHERE OwnerEmailId = '%s' AND OwnerActiveFlag='Active'", DB_PREFIX, OWNER_TABLE, $email);
										
				$row = $db->getRow($query);
			  	
				$pass = decrypt($row['OwnerPassword']);
				if(isset($row)) {
				
					$password = decrypt($row['OwnerPassword']);
					$oname = $row['OwnerName'];
					$site = BASE_URL."admin/login.php";
					
					$subject = "Forgot Password : Konsear.com";
					$msg = 	"<br/><br/>
								
								
								<table width='500px' align='center' style='background-color: #cccccc;'>
									<tr style='background-color: #000000;'>
										<td colspan='2' style='color: #ffffff; font-weight: bold; font-size: 16px; padding: 10px 0 10px 5px;'>
											Forgot Password
										</td>
									</tr>
									<tr>
										<td align='center'>
											<span align='center'><img src='".BASE_URL."images/logok.png'></span>
											<hr/>
										</td>
									</tr>
									<tr>
										<td>
											Hello ".$oname.",
										</td>
									</tr>
									<tr>
										<td><br/>
											You can login to <a href='".$site."'>".$site."</a> using the following username and password<br/><br/>
										</td>
									</tr>
									<tr>
										<td>
											Username :
											".$email."
										</td>
									</tr>
									<tr>
										<td>
											Password :
											".$password."<br/><br/>
											<hr/>
										</td>
									</tr>
									<tr>
										<td align='center'>
											<p align='center'>Konsear App</p>
										</td>
									</tr>
								</table><br/><br/>";
				
				//echo $message;
				
					$from	= ADMIN_EMAIL;
					//Mail to User
					$mailresult = sendEmail($from, $email, $subject, $msg);
					$message = "Please check your mail id for login details";	
					
				}
				else
				{
					
					$message = "Invalid EmailId.";

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
		<p><br/><br/><br/></p>
		<div class="medium-3 columns">&nbsp;</div>
	    <div class="medium-6 columns">
			 <form name="login" id="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size">
				<div class="medium-12 columns bottomspace" style="border: 1px solid #ffffff; border-radius: 10px;">
					
					
					<h3 class="lightgrey">Forgot Password</h3>
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<br/>
					<div class="medium-5 columns">
						<label class="inline">Email</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>">
					</div>
					<div class="medium-5 columns">&nbsp;</div>
					<div class="medium-7 columns">
						<div align="center">
							<input type="submit" name="submit" value="Submit" class="tiny button radius">
						</div>
					</div>
				</div>
			</form>
		</div> 
		<div class="medium-3 columns">&nbsp;</div>
		
		<div class="medium-12 columns"><p><br/></p></div>
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