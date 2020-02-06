<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
	
	/*if(!isset($_SESSION['pubid']))
	{
		redirectPage('login.php');
	}
	else
	{
		$pubid = $_SESSION['pubid'];
	}*/
	$pubid = $_GET['pubid']; 
	$message = "";
	
	
	$db = new VDatabase(true);
			
		$opass	= ($_GET['opass']);
		$npass 	= ($_GET['npass']);
		
		
			$query = sprintf("SELECT PublisherPassword FROM %s%s WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $pubid);
						
			$row = $db->getRow($query); 
			
			if(isset($row))
			{
				
				$pass = decrypt($row['PublisherPassword']);
			}
			
		if($pass != $opass)
		{
			$message = "Old Password was not same";
		}
		else
		{
			$npass = encrypt2way($npass);
			$query = sprintf("UPDATE %s%s SET PublisherPassword = '%s' WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $npass, $pubid);
								
			$row = $db->updateRow($query);
		}
			
		
	$db->closeConnection();
	
?>