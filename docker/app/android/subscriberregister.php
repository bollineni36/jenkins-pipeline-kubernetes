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
		$lastname	= ($_POST['lastname']);
		//$plan 	= ($_POST['plan']);
		$email		= ($_POST['email']);
		$password	= ($_POST['password']);

		//$address 	= ($_POST['address']);
		//$city	 	= ($_POST['city']);
		$state	 	= ($_POST['state']);
	//	$bname		= ($_POST['businessname']);
		$zip		= ($_POST['zipcode']);
		//$category	= ($_POST['category']);
		
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
			$message .= "Provide proper Email";
		}
		elseif(isEmpty($state)) 
		{
			$message .= "Please fill State";
		}
		elseif(isEmpty($zip)) 
		{
			$message .= "Please fill Zip Code";
		} 
		
		
		
		if($message == "")
		{
			
			$password = encrypt2Way($password);
			$image = "";
			
			$query = sprintf("SELECT * FROM %s%s WHERE SubscriberEmailId = '%s'", DB_PREFIX, SUBSCRIBERS_TABLE, $email);
						
			$row = $db->getRow($query); 
			echo $rowfound = $db->noOfRows($query); 
			$email1 = "";
			if($rowfound)
			{
				$email1 = $row['SubscriberId'];
			}
			echo $email1;
			if($email1 == '')
			{
				$sql = sprintf("INSERT INTO %s%s (SubscriberName, SubscriberEmailId, SubscriberPassword, SubscriberState, SubscriberZipcode, SubscriberStartDate, SubscriberActiveFlag) VALUES ('%s','%s','%s','%s','%s',NOW(),'Pending')", DB_PREFIX, SUBSCRIBERS_TABLE, $cname, $email, $password, $state, $zip);

				$db->insertRow($sql);
				
				$pid = $db->getAutoID();
				
				$sqls = sprintf("INSERT INTO kon_tags (SubscriberId, TagName, Status) VALUES ('%s','My Favorites','Active')", $pid);
//echo $sqls;
				$db->insertRow($sqls);
				
				$id = encrypt2Way($pid);
				$site = BASE_URL."android/subactivate.php?id=".$id;
				//$password = decrypt($password);
				$subject = "Thanks for signing up in Konsear.com";
				$msg = 	"Hello ".$cname.",<br/><br/>
							To activate your account Please click on this link <br/><br/><a href='".$site."'>".$site."</a><br/><br/>
							Your login details<br/><br/>
							Email Id: ".$email."<br/>
							Password: ".decrypt($password)."<br/><br/>
							
						Regards<br/>
						Konsear App";
			
			//echo $message;
			
				$from	= ADMIN_EMAIL;  
				//Mail to User
				$mailresult = sendEmail($from, $email, $subject, $msg);
				
				
				/*Mail To Admin*/
				$subject1 = $firstname." : New Subscriber joined in Konsear";
				$msg1 = 	"Hello Admin,<br/><br/>
							The following Subscriber has submitted the Sign Up form:<br/><br/>
							Name: ".$cname."<br/>
							Email: <a href='mailto:".$email."'>".$email."</a><br/>
							Zip Code: ".$zip."<br/>
							Password: ".decrypt($password)."<br/><br/>

						Regards<br/>
						Konsear App";
			
			//echo $message;
			
				$from	= ADMIN_EMAIL;
				
				//Mail to User
				$mailresult = sendEmail($from, $from, $subject1, $msg1);
				
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