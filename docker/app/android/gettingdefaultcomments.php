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
		$db = new VDatabase(true);   
   
   
			$offerid 		= ($_GET['offerid']);
	
			$query = sprintf("SELECT c.SubscriberId as SubscriberIds, c.CommentId, c.Comment, c.DateTime, (SELECT s.SubscriberName FROM kon_subscribers s WHERE s.SubscriberId = c.SubscriberId) AS SubName FROM kon_comments c WHERE c.PublisherOfferId = '%s' ORDER BY c.CommentId DESC", $offerid);
						
			$rows = $db->getRows($query); 
			
			foreach($rows as $row)
			{
				$res[] = array("SubscriberId"=>$row['SubscriberIds'],"CommentId"=>$row['CommentId'],"Comment"=>$row['Comment'],"DateTime"=>$row['DateTime'],"SubName"=>$row['SubName']);
				
			}
		
			    	
			//$res["files"][] = $row;
			echo json_encode($res);



 


?>