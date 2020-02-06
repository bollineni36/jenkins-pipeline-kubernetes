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
		
		$query = sprintf("SELECT * FROM kon_pages WHERE PageName = 'FAQ'");
						
		$row = $db->getRow($query); 
		
		if(isset($row))
		{
			$pg = $row['PageId'];
			$pagename = $row['PageName'];
			echo $desc 	= $row['Description'];
		}	
		
		$db->closeConnection();
?>