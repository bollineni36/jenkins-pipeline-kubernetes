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
		$query1 = sprintf("SELECT * FROM kon_subscribers WHERE SubscriberId = '%s'", $subid);
		$row1 = $db->getRow($query1);	
		
		$cat = $row1['InterestHeaders'];
		
		if($cat == "")
		{
			$catcond = "InterestHeaderId = 0";
		}
		else 
		{
			
			$catids = explode(",",$cat);
			$i=0;
			foreach($catids as $id)
			{
				$i++;
				if($i == 1)
					$catcond = "InterestHeaderId = '".$id."'";
				else
					$catcond .= " OR InterestHeaderId = '".$id."'";
			}	
		}
		$catcond = str_replace(" OR InterestHeaderId = ''","",$catcond);
		$catcond = "(".$catcond.")";
		
		
		$query = sprintf("SELECT * FROM kon_interestheader WHERE %s", $catcond);
		
		$row = $db->getRow($query);
		
		$rows = $db->getRows($query);	
		$i=0;
		$res = array();
		foreach($rows as $row)
			{
			$i++;
				$res[] = array("InterestHeaderId"=>$row['InterestHeaderId'],"InterestHeaderName"=>$row['InterestHeaderName']);
				
			}
			if($i == 0)
			{	echo "You have not setup your preferences yet, please go to Settings and select your interests"; }
			else
			{  	echo json_encode($res); }
			//$res["files"][] = $row;
			
?>