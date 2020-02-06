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
		
		$pid = $_GET['id'];
		$pid = str_replace(" ", "+", $pid);
		$pid = decrypt($pid);
		
		$query = sprintf("UPDATE %s%s SET PublisherActiveFlag = 'Active' WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $pid);
							
		$row = $db->updateRow($query);
		
		$db->closeConnection();
		
		//redirectPage('login.php');
		header("Location: http://konsear.com");
		
?>