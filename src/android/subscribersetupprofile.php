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
		
		//$subid = 1;
		$subid			= ($_POST['subid']);
		$mobile_no	 	= ($_POST['mobile_no']);
		$countryname	= ($_POST['countryname']);
		$statename 		= ($_POST['statename']);
		$zipcode 		= ($_POST['zipcode']);
		$dob	 		= ($_POST['dob']);
		$target_path = "image/";
		
		if(isEmpty($mobile_no)) 
		{
			$message .= "Please fill mobile no";
		}
		elseif(isEmpty($countryname)) 
		{
			$message .= "Please fill country name";
		} 
		elseif(isEmpty($zipcode)) 
		{
			$message .= "Please fill zip code";
		}
		elseif(isEmpty($dob)) 
		{
			$message .= "Please fill date of birth";
		}
		
		if($message == "")
		{
			//$password = generateRandomString();
		//	$password = encrypt2Way($password);
			$image = "";
			
			
			$sql = sprintf("UPDATE %s%s SET SubscriberPhone='%s', SubscriberCountry='%s',SubscriberState='%s', SubscriberZipcode='%s', SubscriberBirthDayMonth='%s' WHERE SubscriberId = %d", DB_PREFIX, SUBSCRIBERS_TABLE, $mobile_no, $countryname,$statename, $zipcode, $dob, $subid);

				$row = $db->updateRow($sql);
				
				if(isset($row))
				{
				$message = "Updation Success";
								
				//$file_exts = array("jpg", "jpeg", "gif", "png");
				$upload_exts = explode(".", $_FILES["file"]["name"]);
				//if ((($_FILES["file"]["type"] == "image/gif")
				//|| ($_FILES["file"]["type"] == "image/jpeg")
				//|| ($_FILES["file"]["type"] == "image/png")
				//|| ($_FILES["file"]["type"] == "image/pjpeg"))
				//&& ($_FILES["file"]["size"] < 4000000))
				//{
						$name=basename( $_FILES['file']['name']);
						//$target_path = $target_path . basename( $_FILES['file']['name']); 
					$target_path = $target_path .$subid.".".$upload_exts[1];
					if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path))
				
					{
						 $imgurl=basename( $_FILES['file']['name']);
						
						$query = sprintf("UPDATE %s%s SET Image = '%s' WHERE SubscriberId = '%s'", DB_PREFIX, SUBSCRIBERS_TABLE, $target_path, $subid);
							
						$row = $db->updateRow($query);
					
					  echo "The file ".BASE_URL."/android/".$target_path."image has been uploaded";
					
					}
						else
						{
					  	$imgurl="photo.png";	   
						 echo "There was an error uploading the image, please try again!";
						}
				
			//	}
					//else{
			
					//	$message .= "Invalid file";
					//}			
			}
			else
			{
			$message = "Updation Failed";
			}	
			
		}	
		echo $message;
		$db->closeConnection();
		
	
	
?>