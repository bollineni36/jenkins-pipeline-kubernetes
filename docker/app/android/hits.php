<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		require_once("includes/classes/VDatabase.php");
		  
		$offerid 		= $_GET['offeridd'];	
		$db = new VDatabase(true);
	 
	 
		
		 $query = sprintf("UPDATE %s%s SET Hits = Hits+1 WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $offerid);							
		$row = $db->updateRow($query);		
			
		$db->closeConnection();
	

 


?>