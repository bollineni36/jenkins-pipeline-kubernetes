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
		
		$sid = $_GET['sid'];
		$distance = $_GET['distance'];
		
		$query = sprintf("UPDATE kon_subscribers SET Distance = '%s' WHERE SubscriberId = '%s'", $distance, $sid);
							
		$row = $db->updateRow($query);
		
		$db->closeConnection();
		
		if($row)
		{
			echo "success";
		}
		else
		{
			echo "failed";
		}
		
?>