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
		$tagid = $_GET['tagid'];
		$offerid = $_GET['offerid'];
		
		$query = sprintf("SELECT SubscriberTagId FROM kon_subscribertags WHERE PublisherOfferId = '%s' AND SubscriberId = '%s'", $offerid, $subid);
						
			$row1 = $db->getRow($query); 
			//echo "update".$row1;
			$subtagid = "";
			if(isset($row1))
			{
				$sql = sprintf("UPDATE kon_subscribertags SET TagId='%s', SubscribertagActiveFlag='Active' WHERE SubscriberId = %s AND PublisherOfferId = %s", $tagid, $subid, $offerid);

				$row = $db->updateRow($sql);
				//echo "updated";
				$subtagid = $row1['SubscriberTagId'];
			}
			if($subtagid == '')
			{
				$sqls = sprintf("INSERT INTO kon_subscribertags (SubscriberId, TagId,PublisherOfferId,SubscriberTagStartDate, SubscribertagActiveFlag) VALUES ('%s','%s','%s',now(),'Active')", $subid, $tagid,$offerid);

				$db->insertRow($sqls);			
				$subtagid = $db->getAutoID();
				echo "subtag".$subtagid;
			}
		
	/*	$res = array();
		foreach($rows as $row)
			{
				$res[] = array("InterestHeaderId"=>$row['InterestHeaderId'],"InterestHeaderName"=>$row['InterestHeaderName']);
				
			}*/
		
			    	
			//$res["files"][] = $row;
			echo json_encode($subtagid);
?>