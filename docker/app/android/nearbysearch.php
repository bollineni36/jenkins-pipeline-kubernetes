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

    
	$subid 		= ($_GET['subid']);
	
	$query1 = sprintf("SELECT * FROM %s%s WHERE SubscriberId = '%s'", DB_PREFIX, SUBSCRIBERS_TABLE, $subid);
		$row = $db->getRow($query1); 
	$zip = $row['SubscriberZipcode'];
		
			 $query = sprintf("SELECT * FROM %s%s o, %s%s a WHERE o.OfferActiveFlag = 'Active' AND a.AccountId = o.AccountId AND a.AccountZipcode = '%s' ORDER BY PublisherOfferId DESC", DB_PREFIX, PUBLISHEROFFERS_TABLE, DB_PREFIX, ACCOUNT_TABLE, $zip);
			
		//	$rows = $db->getRows($query); 
	
	// $query = sprintf("SELECT *,(SELECT ih.InterestHeaderName FROM kon_interestheader ih WHERE po.CategoryId = ih.InterestHeaderId) as InterestHeader,(SELECT id.InterestDetailName FROM kon_interestdetails id WHERE po.SubCategoryId = id.InterestDetailId) as InterestDetailName,(SELECT ot.OfferTypeName FROM kon_offertypes ot WHERE po.OfferTypeId = ot.OfferTypeId) as OfferTypeName,(SELECT CONCAT(a.AccountAddress1,', ',a.AccountCity,', ',a.AccountState,' ',a.AccountZipcode,', ',a.AccountCountry) FROM kon_account a WHERE po.AccountId = a.AccountId) as Address,(SELECT AccountWebsite FROM kon_account a WHERE po.AccountId = a.AccountId) as AccountWebsite FROM kon_publisheroffers po");
  //  echo $query;
		$result = $db->getRows($query);
		
		$i=0;
		 $rowNos = $db->noOfRows($query);
		$res = array();
		if($rowNos >=1)
		{
			
			foreach($result as $row)
			{
			$i++;
		/*		$res['SubscriberName'] = $row['SubscriberName'];		
				$res['SubscriberEmailId'] = $row['SubscriberEmailId'];
				$res['SubscriberPhone'] = $row['SubscriberPhone'];*/
				$res[] = array("OfferName"=>$row['OfferName'],"RegPrice"=>$row['RegPrice'],"OfferPrice"=>$row['OfferPrice'],"OfferPercent"=>$row['OfferPercent'],"OfferEndDate"=>$row['OfferEndDate'],"OfferImage"=>$row['OfferImage'],"PublisherOfferId"=>$row['PublisherOfferId'],"OfferDesc"=>$row['OfferDesc'],"Address"=>$row['AccountAddress1'],"Website"=>$row['AccountWebsite'],"OfferType"=>$row['OfferTypeName']);
				
			}
		
			    	
			if($i==0)
				echo "failed";
				else
			echo json_encode($res);
		}
		else
		{
			echo 'NotFound';
		}



 


?>