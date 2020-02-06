<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		
		
	$amt = $_SESSION["amt"];
	if($_SESSION['paypalpage'] == "pay_upgrade.php")
	{
	
		$pid = $_SESSION['pubid'];
		$planname = $_SESSION['planname'];
		$firstdate = $_SESSION['firstdate'];
		$lastdate = $_SESSION['lastdate'];
		
		if($planname == "Silver Plan")
			$planid = 2;
		elseif($planname == "Gold Plan")
			$planid = 3;
		elseif($planname == "Platinum Plan")
			$planid = 4;
			
		$_SESSION['planid'] = $planid;
			
		$db = new VDatabase(true);
		
		$query = sprintf("UPDATE %s%s SET PublisherActiveFlag = 'Active', PublisherStartDate = '%s', PublisherEndDate = '%s', PublisherPlanId = '%s' WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $firstdate, $lastdate, $planid, $pid);
							
		$row = $db->updateRow($query);
		
		if($planname == "Silver Plan")
		{
			$query5 = sprintf("SELECT AccountId FROM %s%s WHERE PublisherId = '%s' AND PublisherActiveFlag = 'Active' LIMIT 1", DB_PREFIX, ACCOUNT_TABLE, $pid);
			
			$row5 = $db->getRow($query5); 
			
			$acid = $row5['AccountId'];
			
			$query = sprintf("UPDATE %s%s SET PublisherActiveFlag = 'Inactive' WHERE PublisherId = '%s' AND AccountId <> '%s' ", DB_PREFIX, ACCOUNT_TABLE, $pid, $acid);
							
			$row = $db->updateRow($query);
		}
		
		$db->closeConnection();
		
			
		
		unset($_SESSION['planname']);
		unset($_SESSION['firstdate']);
		unset($_SESSION['lastdate']);
		unset($_SESSION['paypalpage']);
		
		redirectPage('index.php');
	}
	else
	{
		redirectPage('index.php');
	}
?>