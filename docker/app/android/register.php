<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
	
	
	$message = "";
	/*if(isset($_POST['submit']))
	{*/
		$db = new VDatabase(true);
			
		$firstname	= ($_POST['firstname']);
		$lastname		= ($_POST['lastname']);
		//$plan 		= ($_POST['plan']);
		$email		= ($_POST['email']);
		$password	= ($_POST['password']);

		//$address 	= ($_POST['address']);
		//$city	 	= ($_POST['city']);
		//$state	 	= ($_POST['state']);
		$bname		= ($_POST['businessname']);
		$zip		= ($_POST['zipcode']);
		$countryname	= ($_POST['countryname']);
		$category	= ($_POST['category']);
		$statename	= ($_POST['statename']);
		
	//	$terms   	= isset($_POST['terms']) ? $_POST['terms'] : NULL;
			
		
		$cname = $firstname." ".$lastname; 
		
		if(isEmpty($firstname)) 
		{
			$message .= "Please fill First Name";
		}
		elseif(isEmpty($lastname)) 
		{
			$message .= "Please fill Last Name";
		}
		elseif(isEmpty($bname)) 
		{
			$message .= "Please fill Business Name";
		}
		elseif(isEmpty($password)) 
		{
			$message .= "Please fill Password";
		}
		elseif(isEmpty($email)) 
		{
			$message .= "Please fill Email";
		} 
		elseif(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
		{
			$strMessage .= "Provide proper Email";
		}
		elseif(isEmpty($zip)) 
		{
			$message .= "Please fill Zipcode";
		}
		elseif(isEmpty($category)) 
		{
			$message .= "Please select Category";
		}
		
		if($message == "")
		{
			$password = encrypt2Way($password);
			$image = "";
			
			$query = sprintf("SELECT PublisherEmailId FROM %s%s WHERE PublisherEmailId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $email);
						
			$row = $db->getRow($query); 
			$email1 = "";
			if(isset($row))
			{
				$email1 = $row['PublisherEmailId'];
			}
			if($email1 == '')
			{
			$sql = sprintf("INSERT INTO %s%s (PublisherName, PublisherDbaName, PublisherZipcode, PublisherEmailId, PublisherPassword,PublisherCountry,PublisherState, InterestHeaderId, PublisherTermAcceptanceFlag, PublisherPlanId, PublisherStartDate, PublisherActiveFlag) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','Yes','1',NOW(),'Pending')", DB_PREFIX, PUBLISHER_TABLE, $cname, $bname, $zip, $email, $password,$countryname,$statename, $category);

				$db->insertRow($sql);
				
				$pid = $db->getAutoID();
				
				
				$sql1 = sprintf("INSERT INTO %s%s (PublisherId, AccountName	, AccountState, AccountZipcode, AccountCountry, AccountContactName, AccountEmailId, InterestHeaderId, PublisherActiveFlag) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','Active')", DB_PREFIX, ACCOUNT_TABLE, $pid, $cname, $statename, $zip, $countryname, $cname, $email, $category);

				$db->insertRow($sql1);
				
				$id = encrypt2Way($pid);
				$site = BASE_URL."android/activate.php?id=".$id;
				$password = decrypt($password);
				$subject = "Thanks for signing up in Konsear.com";
				$msg = 	"Hello ".$cname.",<br/><br/>
							To activate your account Please click on this link <br/><br/><a href='".$site."'>".$site."</a>";
			
			//echo $message;
			
				$from	= ADMIN_EMAIL;
				//Mail to User
				$mailresult = sendEmail($from, $email, $subject, $msg);
				
				if($mailresult == "success")
				{	$message = "success";	}
				else
				{	$message = $mailresult;	}
				$message = "Success";
			}
			else
			{
				$message = "Email Id was already used";
			}
		}
		echo $message;
		
		$db->closeConnection();
		
	
	
?>