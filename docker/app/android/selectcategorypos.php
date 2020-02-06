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
			$selectedPos = ($_GET['selectedPos']);
			$selectedPos = str_replace("Selected positions: ","",$selectedPos);
			
			echo $sql = sprintf("UPDATE kon_subscribers SET InterestHeaders='%s' WHERE SubscriberId = '%s'", $selectedPos, $subid);

				$row = $db->updateRow($sql);
				
				if(isset($row))
				{
					$message = "Updation Success";
				}
				else
				{
					$message="failed";
				}
				echo $message;
			$db->closeConnection();	
	
	
?>