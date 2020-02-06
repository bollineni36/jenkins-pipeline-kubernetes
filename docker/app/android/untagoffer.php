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
		
		$sql = sprintf("UPDATE kon_subscribertags SET SubscribertagActiveFlag='Inactive', SubscriberTagEndDate=NOW() WHERE SubscriberId = %s AND PublisherOfferId = %s AND SubscribertagActiveFlag='Active'", $subid, $offerid);

				$row = $db->updateRow($sql);
				if(isset($row))
				 echo "success";
		
			//echo json_encode($tagid);
?>