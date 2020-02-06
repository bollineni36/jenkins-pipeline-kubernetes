<?php
include "connection.php";

echo $fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$name = $fname.' '.$lname;
$email=$_POST['email'];
$password=$_POST['password'];

//$target_path = "../VendorProfile/";
//$target_path="http://projects.ashwatthainteriors.com/projects/SocialRestrictor/childimages/";

$result= mysql_query("SELECT * FROM kon_publisher WHERE PublisherEmailId='$email'");
$rows = mysql_num_rows($result);

if($rows>0)
{
	$vam='fail';
}
else
{
mysql_query("INSERT INTO kon_publisher(PublisherName,PublisherEmailId,PublisherPassword) VALUES ('$name','$email','$password')") ; //or $vam=array('success'=>"Duplicate serial number")
	$vam='success';
}
echo json_encode($vam);
?>
