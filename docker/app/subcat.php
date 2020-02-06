<?php
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		
		if(!isset($_SESSION['pubid'])) 
		{
			redirectPage('index.php');
		}
		
		echo $catid = $_POST["catid"];
		
		if($catid > 0)
		{
		
		
			$query = sprintf(" SELECT InterestDetailId, InterestDetailName FROM %s%s WHERE status = 'Active' AND InterestHeaderId = %s", DB_PREFIX, INTERESTDETAILS_TABLE, $catid);
			echo fillDropdown($query, (isset($subcategory) ? $subcategory : ''));
		
		}
?>