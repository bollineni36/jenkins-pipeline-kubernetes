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
		//$db = new VDatabase(true);  
		
// // /* Pushnotification--Added--- Android*/

$sql="SELECT Header, Text, DisplayDate FROM mffg_myAlerts ORDER BY DisplayDate DESC limit 1 ";
$res= mysql_query($sql);
while($row=mysql_fetch_array($res))
{
	$header=$row['Header'];
	$messageText=$row['Text'];
	$DisplayDate=$row['DisplayDate'];
}


$query5 = "SELECT devid FROM mffg_devid";
$result5 = mysql_query($query5);

$row_no = 0;
$registrationIDs = array();

while($row = mysql_fetch_array($result5))
{
	$row_no++;
	if($row_no == 1000)
	{
		$row_no = 0;

		$headers = array("Content-Type:application/json","Authorization:key=AIzaSyC77R5tY5K5RkM9WGsWQyYpZ55DXCrJXdc");
		$data = array('registration_ids'=>$registrationIDs,'data'=>array('message'=>$messageText,'header'=>$header,'date'=>$DisplayDate));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		error_log(json_encode($data));
		$response = curl_exec($ch);

		curl_close($ch);

		// reset the array values
		$registrationIDs = NULL;
		$registrationIDs = array();
	}
	else
	{
		$registrationIDs[] = $row['devid'];
	}
}
if($row_no > 0)
{
	$headers = array("Content-Type:application/json","Authorization:key=AIzaSyC77R5tY5K5RkM9WGsWQyYpZ55DXCrJXdc");
	$data = array('registration_ids'=>$registrationIDs,'data'=>array('message'=>$messageText,'header'=>$header,'date'=>$DisplayDate));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

	error_log(json_encode($data));
	$response = curl_exec($ch);

	curl_close($ch);
}


/* Pushnotification--Closed--- android*/
?>