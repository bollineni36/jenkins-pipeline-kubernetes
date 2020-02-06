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
		/*if(isset($_GET['submit']))
		{*/
			$email 		= ($_GET['email']);
			$password 	= ($_GET['password']);
			
			if(isEmpty($email)) 
			{

				$message = "Please Enter Email Id";
							
			}
			elseif(isEmpty($password)) 
			{
			
				$message = "Please Enter Password";
			
			};

			if($message == ""){
							
				
				$query = sprintf("SELECT * FROM %s%s WHERE PublisherEmailId = '%s' AND PublisherActiveFlag='Active'", DB_PREFIX, PUBLISHER_TABLE, $email);
										
				$row = $db->getRow($query);
			  	
				if(isset($row) && (decrypt($row['PublisherPassword']) == $password)) {

						$_SESSION['pubid'] = $row['PublisherId'];
						
						$_SESSION['pname'] = $row['PublisherName'];
						
						$_SESSION['bname'] = $row['PublisherDbaName'];
						
						$_SESSION['emailid'] = $row['PublisherEmailId'];
						
						$_SESSION['status'] = $row['PublisherActiveFlag'];
							
						//redirectPage('index.php');

						//$message = "Success";
						 // echo 'FOUND'.'+'.$_SESSION['pubid'];
							echo 'FOUND'.'+'.$row['PublisherId'].'+'.$row['InterestHeaderId'];
				}
				else
				{
					
					$message = "Invalid EmailId/Password. ";

				} 
				
			} 	
			echo $message;
	//	}
		
		$db->closeConnection();
		
	
	
?>