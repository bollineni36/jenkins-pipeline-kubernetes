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
   
 
    
	$subid 		= ($_GET['subid']);
	$offerid 		= ($_GET['offerid']);
	$commenttext 		= ($_GET['commenttext']);
	
	$query = sprintf("SELECT CommentId FROM kon_comments WHERE PublisherOfferId = '%s' AND SubscriberId = '%s'", $offerid, $subid);
						
			$row = $db->getRow($query); 
			$comid = "";
			if(isset($row))
			{
				$comid = $row['CommentId'];
			}
			if($comid == '')
			{
				$sqls = sprintf("INSERT INTO kon_comments (SubscriberId, PublisherOfferId, Comment, DateTime) VALUES (%s,%s,'%s',NOW())", $subid, $offerid, $commenttext);

				$db->insertRow($sqls);
				
				$res["key"] = "Your comment was successfully posted";
			}
			else
			{
				//$res[] = "You have already commented on this offer";
				$res["key"] = "You have already commented on this offer";
			}
			/*$query = sprintf("SELECT c.CommentId, c.Comment, c.DateTime, (SELECT s.SubscriberName FROM kon_subscribers s WHERE s.SubscriberId = c.SubscriberId) AS SubName FROM kon_comments c WHERE c.PublisherOfferId = '%s' ORDER BY c.CommentId DESC", $offerid);
						
			$rows = $db->getRows($query); 
			
			foreach($rows as $row)
			{
				$res[] = array("CommentId"=>$row['CommentId'],"Comment"=>$row['Comment'],"DateTime"=>$row['DateTime'],"SubName"=>$row['SubName']);
				
			}*/
		
			    	
			//$res["files"][] = $row;
			echo json_encode($res);


 


?>