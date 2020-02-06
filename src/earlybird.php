<?php
	require_once("includes/start.php");
	require_once("includes/config.php");
	require_once("includes/tablenames.php");
	require_once("includes/constants.php");
	require_once("includes/classes/VDatabase.php");
	require_once("includes/vutils.php");
	require_once("includes/vlib.php");

	$emailid = $_POST['emailid'];

	$subject = "Warm welcome from your Personal Concierge";
	$msg = 		"Dear Visitor,<br/><br/>
	
				<div style='padding-left: 35px'>Thank you for visiting us and signing up for a chance to win a Samsung Galaxy Tab 4.<br/><br/>

				We announce our winner every week.<br/><br/>

				If your email wins the prize we will send you the details on how to claim your prize.<br/><br/>

				We are launching our first mobile app soon and will inform you when it is launched so you can start benefiting from your personal concierge.<br/><br/><br/>
				</div>
				Thank you,<br/>
				Konsear Team<br/>
				<a href='konsear.com'>www.konsear.com</a>
			";

//echo $msg;

	$from	= ADMIN_EMAIL;
	//Mail to User
	$mailtoclient = sendEmail($from, $emailid, $subject, $msg);
	
	
	$emailid = $_POST['emailid'];

	$subject = "Entry for Early Bird Offer";
	$msg = 		"Hello Konsear Administrator,<br/><br/>
	
				<div style='padding-left: 35px'>The below email id was submitted for Early Bird Offer. <br/><br/>
				Email ID: ".$emailid."<br/><br/>
				Please check the Email ID and take necessary action.<br/><br/>
				</div>
				Thank you so much!
				
			";

//echo $msg;

	$from	= ADMIN_EMAIL;
	if($emailid != "")
	{
		//Mail to User
		$mailtoclient = sendEmail($from, $from, $subject, $msg);
	}
?>