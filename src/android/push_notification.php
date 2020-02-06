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
	
		$regid = '67d9bf5934d772db';
		
		$fromdate = date('Y-m-d');    
		$todate = date('Y-m-d',strtotime("+2 days")); 
	
		$query = sprintf("SELECT *,(SELECT ih.InterestHeaderName FROM kon_interestheader ih WHERE po.CategoryId = ih.InterestHeaderId) as InterestHeader,(SELECT id.InterestDetailName FROM kon_interestdetails id WHERE po.SubCategoryId = id.InterestDetailId) as InterestDetailName,(SELECT CONCAT(a.AccountAddress1,', ',a.AccountCity,', ',a.AccountState,' ',a.AccountZipcode,', ',a.AccountCountry) FROM kon_account a WHERE po.AccountId = a.AccountId) as Address FROM kon_publisheroffers po WHERE po.OfferEndDate <= '$todate' AND po.OfferEndDate >= '$fromdate'");

		$result = $db->getRow($query);
		
	// API access key from Google API's Console
	define( 'API_ACCESS_KEY', 'AIzaSyC77R5tY5K5RkM9WGsWQyYpZ55DXCrJXdc' );
	$registrationIds = array( $regid );
	// prep the bundle
	$msg = array
	(
		'offerName' => $row['OfferName'],
		'offerDesc'	=> $row['OfferDesc'],
		'address'	=> $row['Address']
	);
	$fields = array
	(
	'registration_ids' => $registrationIds,
	'data'	=> $msg
	);
	$headers = array
	(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
	);
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch );
	curl_close( $ch );
	echo $result; 
?>