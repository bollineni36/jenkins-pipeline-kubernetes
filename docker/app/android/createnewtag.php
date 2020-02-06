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
			$subid = ($_POST['subid']);
			
			$tagname = ($_POST['tagname']);
			
			$query = sprintf("SELECT TagId FROM kon_tags WHERE TagName = '%s' AND SubscriberId = '%s'", $tagname, $subid);
						
			$row = $db->getRow($query); 
			$tag = "";
			if(isset($row))
			{
				$tag = $row['TagId'];
			}
			if($tag == '')
			{
				$sqls = sprintf("INSERT INTO kon_tags (SubscriberId, TagName, Status) VALUES ('%s','%s','Active')", $subid, $tagname);

				$db->insertRow($sqls);
			}
			
			$query = sprintf("SELECT TagId, TagName FROM kon_tags WHERE SubscriberId = '%s' AND Status = 'Active'", $subid);
						
			$rows = $db->getRows($query); 
			
			foreach($rows as $row)
			{
				$res[] = array("TagId"=>$row['TagId'],"TagName"=>$row['TagName']);
				
			}
		
			    	
			//$res["files"][] = $row;
			echo json_encode($res);
	
?>