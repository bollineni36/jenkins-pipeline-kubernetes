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
			$selectedPos = ($_POST['selectedPos']);
			$selectedPos = str_replace("Selected positions: ","",$selectedPos);
			$selectedPos = str_replace("null","",$selectedPos);
			
			echo $sql = sprintf("UPDATE kon_subscribers SET  InterestDetailsId='%s' WHERE SubscriberId = '%s'", $selectedPos, $subid);

				$row = $db->updateRow($sql);
				
				if(isset($row))
				{
				$message = "Updation Success";
				}
				else{
				
				$message="failed";
				
				}
				if($selectedPos == "")
				{
					$message .= " empty";
				}
				else
				{
					$message .= " selected";
				}
				echo $message;
				
			$db->closeConnection();	
	
	
?>