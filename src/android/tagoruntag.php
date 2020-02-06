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
		$subid = $_GET['subid'];
		$offerid = $_GET['offerid'];
		
		$query = sprintf("SELECT SubscriberTagId FROM kon_subscribertags WHERE PublisherOfferId = '%s' AND SubscriberId = '%s' AND SubscribertagActiveFlag='Active'", $offerid, $subid);
						
			$row1 = $db->getRow($query); 
			//echo "update".$row1;
			$tagged = "tag";
			if(isset($row1))
			{
				$tagged = "Untag";
			}
			
			  echo json_encode($tagged);
?>