<?php
$serverName = "10.6.186.105";
$user = "ncplshareddb";
$pass = "1c3f84067ba9";
$dbname = "ncplshareddb";
	if($connectionresource = mysql_connect($serverName, $user, $pass))
	{
		if(!mysql_select_db($dbname,$connectionresource))
			die ("Error while selecting Database.");
	}
	else
		die ("Error while connecting to server.");
?>