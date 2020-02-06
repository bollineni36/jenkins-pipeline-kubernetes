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
		
		$sid = $_GET['id'];
		$sid = str_replace(" ", "+", $sid);
		$sid = decrypt($sid);
		
		$query = sprintf("UPDATE %s%s SET SubscriberActiveFlag = 'Active' WHERE SubscriberId = '%s'", DB_PREFIX, SUBSCRIBER_TABLE, $sid);
							
		$row = $db->updateRow($query);
		
		$db->closeConnection();
		
		//redirectPage('login.php');
		header("Location: http://konsear.com");
		
?>