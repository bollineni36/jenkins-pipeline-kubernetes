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
		$catid = $_GET['catid'];
					 //$query = sprintf("SELECT * FROM kon_publisheroffers WHERE OfferActiveFlag = 'Active' AND CategoryId = %s", $catid);
					 
		$dayend = date('Y-m-d 00:00:00');
					 
					   $query = sprintf("SELECT *,(SELECT ih.InterestHeaderName FROM kon_interestheader ih WHERE po.CategoryId = ih.InterestHeaderId) as InterestHeader,(SELECT id.InterestDetailName FROM kon_interestdetails id WHERE po.SubCategoryId = id.InterestDetailId) as InterestDetailName,(SELECT ot.OfferTypeName FROM kon_offertypes ot WHERE po.OfferTypeId = ot.OfferTypeId) as OfferTypeName,(SELECT CONCAT(a.AccountAddress1,', ',a.AccountCity,', ',a.AccountState,' ',a.AccountZipcode,', ',a.AccountCountry) as Address FROM kon_account a WHERE po.AccountId = a.AccountId) as Address,(SELECT AccountWebsite FROM kon_account a WHERE po.AccountId = a.AccountId) as AccountWebsite FROM kon_publisheroffers po WHERE OfferActiveFlag = 'Active' AND CategoryId = %s AND OfferEndDate >= '$dayend'", $catid);
					 
					 
					 
						$rows1 = $db->getRows($query);		
						$i=0;						
						$res = array();
						foreach($rows1 as $item)
							{
							$i++;
							//$address = $row['AccountAddress1'].", ".$row['AccountCity'].", ".$row['AccountState'].", ".$row['AccountCountry']." - ".$row['AccountZipcode'];
							$address = $item['Address'];
							
							$offerenddate = toUSFormat($item['OfferEndDate'], FALSE);

							//	$res[] = array("PublisherOfferId"=>$item['PublisherOfferId'],);
								$res[] = array("OfferName"=>$item['OfferName'],"RegPrice"=>$item['RegPrice'],"OfferPrice"=>$item['OfferPrice'],"OfferPercent"=>$item['OfferPercent'],"OfferEndDate"=>$offerenddate,"OfferImage"=>$item['OfferImage'],"Category"=>$item['InterestHeader'],"SubCategory"=>$item['InterestDetailName'],"PublisherOfferId"=>$item['PublisherOfferId'],"OfferDesc"=>$item['OfferDesc'],"Address"=>$address,"Website"=>$item['AccountWebsite'],"OfferType"=>$item['OfferTypeName']);

							}
							if($i==0)
							echo "failed";
							else
							echo json_encode($res);
?>