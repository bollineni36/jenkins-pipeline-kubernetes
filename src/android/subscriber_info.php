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
   
  //  $subid =$_REQUEST ['subid'];
		//$subid = 1;
//    $json = $_SERVER['HTTP_JSON'];
//    $data = json_decode($json);
    
	$subid 		= ($_POST['subid']);
	
$query = "SELECT * FROM kon_subscribers WHERE SubscriberId='".$subid."'";
  //  echo $query;
		$result = mysql_query($query);
		$rowNos = mysql_num_rows($result);
		$res = array();
		if($rowNos >=1){

		while($row = mysql_fetch_assoc($result))
		{
/*		$res['SubscriberName'] = $row['SubscriberName'];		
		$res['SubscriberEmailId'] = $row['SubscriberEmailId'];
		$res['SubscriberPhone'] = $row['SubscriberPhone'];*/
		$res[] = array("SubscriberName"=>$row['SubscriberName'],"SubscriberEmailId"=>$row['SubscriberEmailId'],"SubscriberPhone"=>$row['SubscriberPhone'],"Image"=>$row['Image'],"SubscriberState"=>$row['SubscriberState'],"SubscriberCountry"=>$row['SubscriberCountry'],"SubscriberZipcode"=>$row['SubscriberZipcode']);
		}
		echo json_encode($res);
		}
		else
		{
		echo 'NotFound';
		}



 


?>