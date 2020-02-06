<?php 
		require_once("../includes/start.php");
		require_once("../includes/config.php");
		require_once("../includes/tablenames.php");
		require_once("../includes/constants.php");
		require_once("../includes/classes/VDatabase.php");
		require_once("../includes/vutils.php");
		require_once("../includes/vlib.php");
		require_once("../includes/validations.php");

	
	/*
	if(!isset($_SESSION['pubid']))
	{
		redirectPage('login.php');
	}
	else
	{
		$pubid = $_SESSION['pubid'];
	}*/
	
	$acid = $_POST['aname'];
	
		
		$db = new VDatabase(true);
		$query2 = sprintf(" SELECT InterestHeaderId FROM %s%s WHERE AccountId=%s", DB_PREFIX, ACCOUNT_TABLE, $acid);
		
		$headerrow = $db->getRow($query2);
								
		$catid = $headerrow['InterestHeaderId'];
		
	echo '<input type="hidden" name="catid" value="'.$catid.'">';
	
	echo '<select name="subcatid" id="subcatid">';
	echo '<option value="">Select Sub Category</option>';
	
		
		$db = new VDatabase(true);
		$query = sprintf(" SELECT id.InterestDetailId, id.InterestDetailName FROM %s%s id, %s%s a WHERE InterestDetailActiveFlag = 'Active' AND a.InterestHeaderId = id.InterestHeaderId AND a.AccountId=%s", DB_PREFIX, INTERESTDETAILS_TABLE, DB_PREFIX, ACCOUNT_TABLE, $acid);
//echo $query;
		echo fillDropdown($query, (isset($subcatid) ? $subcatid : ''));
		
		
	echo '</select><span class="vrequire">*</span>';
	
		
?>