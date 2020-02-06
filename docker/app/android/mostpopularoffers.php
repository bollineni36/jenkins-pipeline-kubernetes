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
   
	$dayend = date('Y-m-d 00:00:00');
    
	$query33 = sprintf("SELECT *, (SELECT ot.OfferTypeName FROM kon_offertypes ot WHERE po.OfferTypeId = ot.OfferTypeId) as OfferTypeName,(SELECT CONCAT(a.AccountAddress1,', ',a.AccountCity,', ',a.AccountState,' ',a.AccountZipcode,', ',a.AccountCountry) FROM kon_account a WHERE po.AccountId = a.AccountId) as Address,(SELECT AccountWebsite FROM kon_account a WHERE po.AccountId = a.AccountId) as AccountWebsite FROM %s%s po WHERE po.OfferEndDate >= '$dayend' AND po.OfferActiveFlag = 'Active' ORDER BY Hits DESC LIMIT 20", DB_PREFIX, PUBLISHEROFFERS_TABLE);
	$rows33 = $db->getRows($query33);
		$i=0;
		
		 $rowNos = $db->noOfRows($query33);
		$res = array();
		if($rowNos >=1)
		{
			foreach($rows33 as $row)
			{
			$i++;
				
				$offerenddate = toUSFormat($row['OfferEndDate'], FALSE);
				$res[] = array("OfferName"=>$row['OfferName'],"RegPrice"=>$row['RegPrice'],"OfferPrice"=>$row['OfferPrice'],"OfferPercent"=>$row['OfferPercent'],"OfferEndDate"=>$offerenddate,"OfferImage"=>$row['OfferImage'],"Category"=>$row['InterestHeader'],"SubCategory"=>$row['InterestDetailName'],"PublisherOfferId"=>$row['PublisherOfferId'],"OfferDesc"=>$row['OfferDesc'],"Address"=>$row['Address'],"Website"=>$row['AccountWebsite'],"OfferType"=>$row['OfferTypeName']);
				
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


$db->closeConnection();
 


?>