<?php

		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
		require_once("../includes/SimpleImage.php");
		
		$db = new VDatabase(true);   

		echo $pubid				= ($_POST['pubid']);
		echo $acid				= ($_POST['acid']);
		echo $offer	 			= ($_POST['offer']);
		echo $description		= ($_POST['description']);
		echo $fineprint			= ($_POST['fineprint']);
		echo $regular_price 	= ($_POST['regular_price']);
		echo $offer_price	 	= ($_POST['offer_price']);		
		echo $discount	 		= ($_POST['discount']);
		echo $expiry_date	 	= ($_POST['expiry_date']);
		echo $start_date	 	= ($_POST['start_date']);
		echo $catid				= ($_POST['catid']);
		echo $sub_category	 	= ($_POST['sub_category']);
		echo $offertype		 	= ($_POST['offertype']);

		


			
	//$target_path="http://projects.ashwatthainteriors.com/projects/SocialRestrictor/childimages/";

			echo $sql = sprintf("INSERT INTO %s%s (PublisherId, AccountId, OfferName,OfferDesc, FinePrint, RegPrice,  OfferPrice,OfferPercent,OfferStartDate, OfferEndDate,CategoryId,SubCategoryId,OfferTypeId, OfferActiveFlag) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','Active')", DB_PREFIX, PUBLISHEROFFERS_TABLE, $pubid, $acid, $offer, $description, $fineprint, $regular_price, $offer_price, $discount, $start_date, $expiry_date, $catid, $sub_category, $offertype);

				$insert = $db->insertRow($sql);
				
				 $oid = mysql_insert_id();
				
				$message = "Offer was successfully created";
				
				$file_exts = array("jpg", "jpeg", "gif", "png");
			
							echo $filetype = $_FILES["file"]["type"];
							$filetype = str_replace("image/","",$filetype);
							$filetype = "png";
						    $target_folder = '../uploads/offers/'.$oid.'/'; 
							$my_folder = 'uploads/offers/'.$oid.'/'; 
							if (!file_exists($target_folder)) {
							    mkdir($target_folder, 0777, true);
							}
						//	mkdir($target_folder);
							
						    $upload_image = $target_folder.basename($_FILES['file']['name']);

						    $thumb = $target_folder."thumb.".$filetype;
							$full = $target_folder."full.".$filetype;

							
							$myfile = 'uploads/offers/'.$oid.'/thumb.'.$filetype; 
							
						    $newwidth = "240";
						    $newheight = "180";

						    if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_image)) 
						    {
								smart_resize_image($upload_image, $newwidth, $newheight, false, $thumb, false, false, 100);
								rename($upload_image, $full);
								
								
								
								echo $query = sprintf("UPDATE %s%s SET OfferImage = '%s' WHERE PublisherOfferId = '%s'", DB_PREFIX, PUBLISHEROFFERS_TABLE, $myfile, $oid);
							
								$row = $db->updateRow($query);
						    }
					
					echo "asdf".$rows;
			if($insert>0)
			{
				$msg = "success";
			}
			else
			{
				$msg="failed";	
			}

		//die(mysql_error())

		echo json_encode($msg);
?>