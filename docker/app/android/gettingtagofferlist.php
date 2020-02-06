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
		$subid = $_GET['subid'];
		$tagid = $_GET['tagid'];
		
	 $fromdate = date('Y-m-d'); 
	 $query = sprintf("SELECT *,(SELECT ot.OfferTypeName FROM kon_offertypes ot WHERE o.OfferTypeId = ot.OfferTypeId) as OfferTypeName FROM kon_publisheroffers o, kon_account a, kon_subscribertags t WHERE o.OfferEndDate >= '$fromdate' AND o.PublisherOfferId = t.PublisherOfferId AND t.TagId = %s AND t.SubscriberId = %s AND OfferActiveFlag = 'Active' AND SubscribertagActiveFlag = 'Active' AND a.AccountId = o.AccountId ORDER BY SubscriberTagId DESC", $tagid, $subid);
						
			$rows = $db->getRows($query); 
			$i=0;
			
			foreach($rows as $row)
			{
			$i++;
				$address = $row['AccountAddress1'].", ".$row['AccountCity'].", ".$row['AccountState'].", ".$row['AccountCountry']." - ".$row['AccountZipcode'];
				$offerenddate = toUSFormat($row['OfferEndDate'], FALSE);
				$res[] = array("OfferName"=>$row['OfferName'],"RegPrice"=>$row['RegPrice'],"OfferPrice"=>$row['OfferPrice'],"OfferPercent"=>$row['OfferPercent'],"OfferEndDate"=>$offerenddate,"OfferImage"=>$row['OfferImage'],"PublisherOfferId"=>$row['PublisherOfferId'],"Address"=>$address,"Website"=>$row['AccountWebsite'],"OfferType"=>$row['OfferTypeName']);
				
			}
		if($i==0)
			echo "failed";
		else
			echo json_encode($res);
			    	
			//$res["files"][] = $row;
			
		
		
?>