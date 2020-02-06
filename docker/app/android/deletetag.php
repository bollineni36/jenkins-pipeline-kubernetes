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
			
			$tagid = ($_GET['tagid']);
			
			$query1 = sprintf("UPDATE kon_tags SET Status = 'Inactive' WHERE TagId = '%s'", $tagid);
								
			$row1 = $db->updateRow($query1);
			
			$query = sprintf("SELECT TagId, TagName FROM kon_tags WHERE SubscriberId = '%s' AND Status = 'Active'", $subid);
						
			$rows = $db->getRows($query); 
			
			/*foreach($rows as $row)
			{
				$res[] = array("TagId"=>$row['TagId'],"TagName"=>$row['TagName']);
				
			}				    	
			//$res["files"][] = $row;
			echo json_encode($res);*/
			
			if(isset($rows))
			{
				echo "Success";
			}
			else
			{
				echo "Failed";	
			}
	?>