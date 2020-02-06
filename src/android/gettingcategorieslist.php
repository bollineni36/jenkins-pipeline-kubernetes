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
		$query = sprintf("SELECT * FROM kon_interestheader WHERE InterestHeaderActiveFlag = 'Active'");
						
		$rows = $db->getRows($query);	
		$i=0;
		$res = array();
		foreach($rows as $row)
			{
			$i++;
				$res[] = array("InterestHeaderId"=>$row['InterestHeaderId'],"InterestHeaderName"=>$row['InterestHeaderName']);
				
			}
			if($i==0)
				echo "failed";
				else
			    	
			//$res["files"][] = $row;
			echo json_encode($res);
?>