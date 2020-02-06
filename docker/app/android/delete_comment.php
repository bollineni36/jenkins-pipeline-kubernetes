<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		require_once("includes/classes/VDatabase.php");
		$db = new VDatabase(true);   
   
   
			$commentid	= ($_GET['commentid']);
	
			if($commentid > 0)
			{
				$query = sprintf("DELETE FROM kon_comments WHERE CommentId = '%s'", $commentid);
							
				$rows = mysql_query($query);
				
				echo "Success";	
			}
			else
			{
				echo "Failed";
			}
			
			
?>