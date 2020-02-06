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
		$sortby = $_GET['sortby'];
		
		
		if($sortby == "distance")
		{
			$query1 = sprintf("SELECT * FROM kon_subscribers WHERE SubscriberId = '%s'", $sid);
			
			$rows1 = $db->getRows($query1); 
			$distance = "";
			foreach($rows1 as $row1)
			{
				$distance = $row1['Distance'];
			}
			if($distance == "")
			{
				$query3 = sprintf("UPDATE kon_subscribers SET Distance = '2' WHERE SubscriberId = '%s'", $sid);
							
				$row3 = $db->updateRow($query3);
			}
		}
		
		$query = sprintf("UPDATE kon_subscribers SET SortBy = '%s' WHERE SubscriberId = '%s'", $sortby, $sid);
		
		$row = $db->updateRow($query);
		
		$db->closeConnection();
		
		
			echo "success";
		
		
?>