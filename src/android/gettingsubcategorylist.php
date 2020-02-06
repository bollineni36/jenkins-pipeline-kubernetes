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
	
	$catid = $_GET['catid'];
    $query = sprintf("SELECT InterestDetailId, InterestDetailName FROM kon_interestdetails WHERE InterestDetailActiveFlag='Active' AND InterestHeaderId='%s'", $catid);
	
	$result = $db->getRows($query);
	$rowNos = $db->noOfRows($query);
	
    if($rowNos >=1)
	{
       
		foreach($result as $row)
		{
			$res[] = array("subid"=>$row['InterestDetailId'],"subcatname"=>$row['InterestDetailName']);
			
		}
		echo json_encode($res);
       
    }  
	else 
	{

        echo 'NotFound';
	}
?>