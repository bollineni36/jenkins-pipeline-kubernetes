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
		/*if(isset($_POST['submit']))
		{*/
			$email 		= ($_GET['email']);
			
			if(isEmpty($email)) 
			{

				$message = "Please Enter Email Id";
							
			}

			if($message == ""){
							
				
			 $query = sprintf("SELECT * FROM kon_subscribers WHERE SubscriberEmailId = '%s' AND SubscriberActiveFlag = 'Active'", $email);
				//echo $query;						
				$row = $db->getRow($query);
			  	//echo decrypt($row['SubscriberPassword']);
				
				if(isset($row)) {
				
						$subid = $row['SubscriberId'];
						
						$pname= $row['SubscriberName'];		
												
						$emailid = $row['SubscriberEmailId'];
						
						$status= $row['SubscriberActiveFlag'];
						
						//$message = "Success";
					 $message = 'FOUND'.'+'.$subid;
					 
						if($row['SubscriberState'] == "")
						{
							$message .= "+noprofile";	
						}
				}
				else
				{
					
					$message = "Invalid EmailId/Password";

				} 
				
			} 	
			echo $message;
	//	}
		
		$db->closeConnection();
		
	
	
?>