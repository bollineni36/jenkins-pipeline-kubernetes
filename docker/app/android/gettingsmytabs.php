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
		
		$message = "";
			$subid = ($_GET['subid']);
			
		 $query = sprintf("SELECT TagId, TagName FROM kon_tags WHERE SubscriberId = '%s' AND Status='Active'", $subid);
						
			$rows = $db->getRows($query); 
			$i=0;
			foreach($rows as $row)
			{
				$i++;
				$res[] = array("TagId"=>$row['TagId'],"TagName"=>$row['TagName']);
				
			}
		
			   if($i==0)
				echo "failed";
				else 	
				echo json_encode($res);
	
?>