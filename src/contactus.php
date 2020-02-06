<?php 
	require_once("includes/start.php");
	require_once("includes/config.php");
	require_once("includes/tablenames.php");
	require_once("includes/constants.php");
	require_once("includes/classes/VDatabase.php");
	require_once("includes/vutils.php");
	require_once("includes/vlib.php");
	require_once("includes/validations.php");
	
	$db = new VDatabase(true);
		$message = "";
		if(isset($_POST['submit']))
		{
			$name 		= ($_POST['name']);
			$phone 		= ($_POST['phone']);
			$email 		= ($_POST['email']);
			$msg	= ($_POST['message']);
			
			if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) 
			{
	        	$message = "Invalid captcha";
		    } 
			elseif(isEmpty($name)) 
			{
				$message = "Please Enter Your Name";				
			}
			elseif(isEmpty($email)) 
			{
				$message = "Please Enter Email Id";				
			}
			elseif(!isValidEmail($email))
			{
				$message = "Please fill valid Email Id";
			}
			elseif(isEmpty($msg)) 
			{
				$message = "Please fill Message";				
			}

			if($message == ""){
										
					$subject = "Message from ".$name." : Konsear.com";
					$msgs = 	"<br/><br/>
																
								<table width='500px' align='center' style='background-color: #cccccc;'>
									<tr style='background-color: #000000;'>
										<td colspan='2' style='color: #ffffff; font-weight: bold; font-size: 16px; padding: 10px 0 10px 5px;'>
											Message Details
										</td>
									</tr>
									<tr>
										<td>
											Name :
										</td>
										<td>
											".$name."
										</td>
									</tr>
									<tr>
										<td>
											Phone :
										</td>
										<td>
											".$phone."
										</td>
									</tr>
									<tr>
										<td>
											Email :
										</td>
										<td>
											".$email."
										</td>
									</tr>
									<tr>
										<td>
											Message :
										</td>
										<td>
											".$msg."
										</td>
									</tr>
								</table><br/><br/>";
				
				//echo $message;
				
					$to	= ADMIN_EMAIL;
					//Mail to User
					$mailresult = sendEmail($email, $to, $subject, $msgs);
					
					
					
					/*Mail to User*/
					$subject = "Thanks for contacting Konsear.com";
					$msgs2 = 	"<br/><br/>
								Dear ".$name.",<br/><br/>
								Thank you for contacting us, we will review your request and will get back to you at our earliest. <br/><br/>

Please DO NOT reply to this email as this is an auto responding message. If you want to contact us please email at <a href='mailto:sales@konsear.com'>sales@konsear.com</a>.<br/><br/>

Best Wishes,<br/>
Konsear Team

								";
				
				//echo $message;
					$from = ADMIN_EMAIL;
					$to	= $email;
					//Mail to User
					$mailresult = contactEmail($from, $to, $subject, $msgs2);
					
					$message = "Message sent successfully";	
					
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
	
  
	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row">
		<div class="hideinmobile"><?php include('leftbar.php'); ?></div>
	    <div class="medium-6 columns">
			 <form name="login" id="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size">
				<div class="medium-12 columns bottomspace">
					
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<h3 class="lightgrey">Contact Us</h3>
					<br/>
					<div class="medium-5 columns">
						<label class="inline">Name</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="name" id="name" value="<?php if(isset($name)) echo $name; ?>">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Phone</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="phone" id="phone" value="<?php if(isset($phone)) echo $phone; ?>">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Email</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>">
					</div>
					<div class="medium-5 columns">
						<label class="inline">Message</label>
					</div>
					<div class="medium-7 columns">
						<textarea name="message" id="message"></textarea>
					</div>
					
					
					<div class="medium-5 columns">
						
							<label class="inline">Captcha</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="captcha" id="captcha-form" autocomplete="off" />
					</div>
					<div class="row">
						<div class="medium-5 columns">
							&nbsp;
						</div>
						<div class="medium-7 columns">
							<div align="center" class="vbottomspace" style="width: 91%;">
								<img src="captcha.php" id="captcha" /><br/><br/>
								<!-- CHANGE TEXT LINK -->
								<a href="#" onclick="document.getElementById('captcha').src='captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();" id="change-image">Not readable? Change text.</a>
							</div>
						</div>
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