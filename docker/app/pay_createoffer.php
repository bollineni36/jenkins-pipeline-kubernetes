<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		
		//echo $_GET['amt'];
		if(isset($_GET["amt"]))
		{
			//echo $_SESSION['paypalpage'];
			if(isset($_SESSION['paypalpage']))
			{
				//echo $_SESSION['paypalpage'];
				if($_SESSION['paypalpage'] != "pay_createoffer.php")
				{
					redirectPage($_SESSION['paypalpage']);
				}
			}
		}
	 	$amt = $_GET["amt"];
		$pubid = $_SESSION['pubid'];
	if($amt == $_SESSION['amt'])
	{
	
		$oid = $_SESSION['od'];
		$oname = $_SESSION['oname'];
		$firstdate = $_SESSION['firstdate'];
		$lastdate = $_SESSION['lastdate'];
		
		$db = new VDatabase(true);
		
//		$query = sprintf("UPDATE %s%s SET PublisherStartDate = '%s' AND PublisherEndDate = '%s' WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $firstdate, $lastdate, $oid);
		echo $query = sprintf("UPDATE %s%s SET PublisherEndDate = '%s' WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $lastdate, $pubid);
							
		$row = $db->updateRow($query);
		
		$query1 = sprintf("UPDATE %s%s SET OfferActiveFlag = 'Active' WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $oid);
			
		$row1 = $db->updateRow($query1);
		
		$db->closeConnection();
			
		$subject = $oname." : New Offer Created";
					$msgs = 	"<br/><br/>
																
								<table width='500px' align='center' style='background-color: #cccccc;'>
									<tr style='background-color: #000000;'>
										<td colspan='2' style='color: #ffffff; font-weight: bold; font-size: 16px; padding: 10px 0 10px 5px;'>
											Offer Details
										</td>
									</tr>
									<tr>
										<td>
											Offer Name :
										</td>
										<td>
											".$oname."
										</td>
									</tr>
									
									<tr>
										<td colspan='2' style='text-align: center'>
											Click <a href='".BASE_URL."offer_details.php?od=".$oid."'>here</a> for offer details
										</td>
									</tr>
								</table><br/><br/>";
				
				//echo $message;
				
					$to	= ADMIN_EMAIL;
					//Mail to User
					$mailresult = sendEmail($to, $to, $subject, $msgs);
					
		unset($_SESSION['od']);
		unset($_SESSION['firstdate']);
		unset($_SESSION['lastdate']);
		unset($_SESSION['paypalpage']);
		
	redirectPage('manage_offers.php');
	}
	else
	{
		redirectPage('index.php');
	}
?>