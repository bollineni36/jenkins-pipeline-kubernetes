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
		
			$email 		= ($_GET['email']);			
			
			if($email == "") 
			{

				$message = "Please Enter Email Id";
							
			}
			else
			{

				$query = sprintf("SELECT  SubscriberId, SubscriberName, SubscriberPassword, SubscriberEmailId  FROM %s WHERE SubscriberEmailId = '%s'", kon_subscribers, $email);
										
				$row = $db->getRow($query);
			  	
				$pass = decrypt($row['SubscriberPassword']);
				if(isset($row)) {
				
					$password = decrypt($row['SubscriberPassword']);
					$cname = $row['SubscriberName'];
					$site = BASE_URL."login.php";
					
					$subject = "Forgot Password : Konsear.com";
					$msg = 	"Hello ".$cname.",<br/><br/>
								
								
								<table width='500px' align='center' style='background-color: #cccccc;'>
									<tr style='background-color: #000000;'>
										<td colspan='2' style='color: #ffffff; font-weight: bold; font-size: 16px; padding: 10px 0 10px 5px;'>
											Forgot Password
										</td>
									</tr>
									<tr>
										<td align='center'>
											<img src='".BASE_URL."images/logok.png'>
										</td>
									</tr>
									<tr>
										<td><br/>
											Use the following username and password to log into Konsear App<br/><br/>
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
										</td>
									</tr>
								</table><br/><br/>
								Regards<br/>
								Konsear App";
				
				//echo $message;
				
					$from	= ADMIN_EMAIL;
					//Mail to User
					$mailresult = sendEmail($from, $email, $subject, $msg);
					$message = "Please check your mail id for login details";	
				}
				else
				{
					
					$message = "Invalid EmailId/Password";

				} 
			}
			echo $message;
	//	}
		
		$db->closeConnection();
		
	
	
?>