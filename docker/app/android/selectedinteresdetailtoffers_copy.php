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
	
	//$query1 = sprintf("SELECT * FROM %s%s WHERE SubscriberId = '%s'", DB_PREFIX, SUBSCRIBERS_TABLE, $subid);
		
		
		$query1 = sprintf("SELECT *,(SELECT ih.InterestHeaderName FROM kon_interestheader ih WHERE po.CategoryId = ih.InterestHeaderId) as InterestHeader,(SELECT id.InterestDetailName FROM kon_interestdetails id WHERE po.SubCategoryId = id.InterestDetailId) as InterestDetailName,(SELECT CONCAT(a.AccountAddress1,', ',a.AccountCity,', ',a.AccountState,' ',a.AccountZipcode,', ',a.AccountCountry) FROM kon_account a WHERE po.AccountId = a.AccountId) as Address FROM kon_subscriber po WHERE OfferActiveFlag = 'Active' AND SubscriberId = %s", $subid);
		$row = $db->getRow($query1); 
		
		
	$zip = $row['SubscriberZipcode'];
	$subcat = $row['InterestDetailsId'];
	if($subcat == "")
	{
		$subcatcond = SubCategoryId;
	}
	else 
	{
		
		$subcatids = explode(",",$subcat);
		$i=0;
		foreach($subcatids as $id)
		{
			$i++;
			if($i == 1)
				$subcatcond = "SubCategoryId = '".$id."'";
			else
				$subcatcond .= " OR SubCategoryId = '".$id."'";
		}	
	}
	$subcatcond = str_replace(" OR SubCategoryId = ''","",$subcatcond);
	$subcatcond = "(".$subcatcond.")";
		
			  $query = sprintf("SELECT * FROM %s%s o, %s%s a WHERE o.OfferActiveFlag = 'Active' AND a.AccountId = o.AccountId AND %s ORDER BY PublisherOfferId DESC", DB_PREFIX, PUBLISHEROFFERS_TABLE, DB_PREFIX, ACCOUNT_TABLE, $subcatcond);
		
		$result = $db->getRows($query);
		
		$i=0;
		 $rowNos = $db->noOfRows($query);
		$res = array();
		if($rowNos >=1)
		{
			
			foreach($result as $row)
			{
			$i++;
				
				$res[] = array("OfferName"=>$row['OfferName'],"RegPrice"=>$row['RegPrice'],"OfferPrice"=>$row['OfferPrice'],"OfferPercent"=>$row['OfferPercent'],"OfferEndDate"=>$row['OfferEndDate'],"OfferImage"=>$row['OfferImage'],"PublisherOfferId"=>$row['PublisherOfferId'],"OfferDesc"=>$row['OfferDesc'],"Address"=>$row['Address']);
				
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