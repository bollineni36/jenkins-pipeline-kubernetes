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
	
	$query1 = sprintf("SELECT * FROM %s%s WHERE SubscriberId = '%s'", DB_PREFIX, SUBSCRIBERS_TABLE, $subid );
		$row = $db->getRow($query1); 
	//$zip = $row['SubscriberZipcode'];
	$cat = $row['InterestHeaders'];
	$subcat = $row['InterestDetailsId'];
	if($cat == "")
	{
		$catcond = "CategoryId > 0";
	}
	else 
	{
		
		$catids = explode(",",$cat);
		$i=0;
		foreach($catids as $id)
		{
			$i++;
			if($i == 1)
				$catcond = "CategoryId = '".$id."'";
			else
				$catcond .= " OR CategoryId = '".$id."'";
		}	
	}
	$catcond = str_replace(" OR CategoryId = ''","",$catcond);
	$catcond = "(".$catcond.")";
	
	if($subcat == "")
	{
		$subcatcond = "SubCategoryId > 0";
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
		
		$dayend = date('Y-m-d 00:00:00');
		
		$query = sprintf("SELECT * FROM %s%s o, %s%s a  WHERE o.OfferEndDate >= '$dayend' AND o.OfferActiveFlag = 'Active' AND a.AccountId = o.AccountId AND %s AND %s ORDER BY PublisherOfferId DESC", DB_PREFIX, PUBLISHEROFFERS_TABLE, DB_PREFIX, ACCOUNT_TABLE, $catcond, $subcatcond);
			
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
				$address = $row['AccountAddress1'].", ".$row['AccountCity'].", ".$row['AccountState'].", ".$row['AccountCountry']." - ".$row['AccountZipcode'];
				$offerenddate = toUSFormat($row['OfferEndDate'], FALSE);
				$res[] = array("OfferName"=>$row['OfferName'],"RegPrice"=>$row['RegPrice'],"OfferPrice"=>$row['OfferPrice'],"OfferPercent"=>$row['OfferPercent'],"OfferEndDate"=>$offerenddate,"OfferImage"=>$row['OfferImage'],"PublisherOfferId"=>$row['PublisherOfferId'],"OfferDesc"=>$row['OfferDesc'],"FinePrint"=>$row['FinePrint'],"Address"=>$address,"Website"=>$row['AccountWebsite'],"Phone"=>$row['AccountPhone'],"OfferType"=>$row['OfferTypeName']);
				
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