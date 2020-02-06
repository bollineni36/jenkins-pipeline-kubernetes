<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		
		
	$amt = $_SESSION["amt"];
	if($_SESSION['paypalpage'] == "pay_register.php")
	{
	
		$pid = $_SESSION['pd'];
		$sid = $_SESSION['sd'];
		$cname = $_SESSION['cname'];
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		
		$db = new VDatabase(true);
		
		$query = sprintf("UPDATE %s%s SET PublisherActiveFlag = 'Active' WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $pid);
							
		$row = $db->updateRow($query);
		
		$query1 = sprintf("UPDATE %s%s SET PublisherActiveFlag = 'Active' WHERE AccountId = '%s'", DB_PREFIX, ACCOUNT_TABLE,  $sid);
			
		$row1 = $db->updateRow($query1);
		
		$db->closeConnection();
		
		$site = BASE_URL."login.php";
		$password = decrypt($password);
		$subject = "Thanks for signing up in Konsear.com";
		$msg = 	"<table width='100%' align='center' style='background-color: #f0f0f0;'>
								<tr>
									<td>
										<br/><br/><br/>
										<table width='500px' align='center'>
											<tr>
												<td align='center'>
													<span align='center'><img src='".BASE_URL."images/logok.png'></span>
													<hr/>
												</td>
											</tr>
											<tr>
												<td>
													<p style='text-align: center;'>Hello ".$cname.",</p><br/><br/>
													<br/>
													<p style='text-align: center;'>Click the button below to login into your Konsear account.</p><br/> 
													<p style='text-align: center;'><a href='".$site."'><img src='".BASE_URL."images/clicksme.gif' align='center'></a></p> <br/>Use the following username and password to login into your account<br/><br/>
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
													".$password."<br/><br/><br/><br/>
												</td>
											</tr>
											<tr>
												<td align='center'>
													<hr/>
													Konsear App
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
								<br/><br/>";
	
	//echo $message;
		$from	= ADMIN_EMAIL;
		//Mail to User
		$mailresult = sendEmail($from, $email, $subject, $msg);
		
		
		unset($_SESSION['pd']);
		unset($_SESSION['sd']);
		unset($_SESSION['cname']);
		unset($_SESSION['password']);
		unset($_SESSION['email']);
		unset($_SESSION['paypalpage']);
		
		redirectPage('login.php');
	}
	else
	{
		redirectPage('index.php');
	}
?>