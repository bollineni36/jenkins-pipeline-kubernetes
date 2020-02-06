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
		
		$pubid = $_GET['pubid'];
		
		$query = sprintf("SELECT AccountId, AccountName FROM %s%s WHERE PublisherId = '%s' AND PublisherActiveFlag = 'Active'", DB_PREFIX, ACCOUNT_TABLE, $pubid); 
	 	
		$result = $db->getRows($query);
		
		$i=0;
		 $rowNos = $db->noOfRows($query);
		$res = array();
		if($rowNos >=1)
		{
			foreach($result as $row)
			{
				$i++;
				$res[] = array("AccountId"=>$row['AccountId'],"AccountName"=>$row['AccountName']);
				
			}
			if($i==0)
				echo "failed";
			else
				echo json_encode($res);
		}
		else
		{
			echo 'NotFound';
		}
		
		$db->closeConnection();		
?>