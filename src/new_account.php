<?php 
		require_once("includes/start.php");
		require_once("includes/config.php");
		require_once("includes/tablenames.php");
		require_once("includes/constants.php");
		require_once("includes/classes/VDatabase.php");
		require_once("includes/vutils.php");
		require_once("includes/vlib.php");
		require_once("includes/validations.php");
	
	if(!isset($_SESSION['pubid']))
	{
		redirectPage('login.php');
	}
	else
	{
		$pubid = $_SESSION['pubid'];
	}
	$message = "";
	
	
	$db = new VDatabase(true);
		
		//To get publisher details
		$query = sprintf("SELECT * FROM  %s%s WHERE PublisherId = '%s'", DB_PREFIX, PUBLISHER_TABLE, $pubid);
						
		$row = $db->getRow($query);
		
		$count = 0;
		//To get Accounts list
		$query1 = sprintf("SELECT * FROM  %s%s WHERE PublisherId = '%s'", DB_PREFIX, ACCOUNT_TABLE, $pubid);
						
		$row1 = $db->getRow($query1); 
		$count = $db->noOfRows($query1);
		
		$start 	= $row['PublisherStartDate'];
		$end	= $row['PublisherEndDate'];
		$plan	= $row['PublisherPlanId'];
		if($count == 1 && $plan == "1")
		{
			$_SESSION['errormsg'] = "Starter Pack members can't create more accounts";
			redirectPage('accounts.php');
		}
		if($count == 2 && $plan == "2")
		{
			$_SESSION['errormsg'] = "Silver Pack members can't create more than 2 accounts";
			redirectPage('accounts.php');
		}
		
		
	if(isset($_POST['submit']))
	{
			
		$bname		= ($_POST['bname']);
		$address 	= ($_POST['address']);
		$city	 	= ($_POST['city']);
		$state	 	= ($_POST['state']);
		$zip		= ($_POST['zip']);
		$country 	= ($_POST['country']);
		$cname	 	= ($_POST['cname']);
		$email		= ($_POST['email']);
		$phone	 	= ($_POST['phone']);
		$category	= ($_POST['category']);
			
		if(isEmpty($bname)) 
		{
			$message .= "Please fill Business Name";
		}
		elseif(isEmpty($address)) 
		{
			$message .= "Please fill Address";
		}
		elseif(isEmpty($city)) 
		{
			$message .= "Please fill City";
		}
		elseif(isEmpty($state)) 
		{
			$message .= "Please fill State";
		}
		elseif(isEmpty($zip)) 
		{
			$message .= "Please fill Zipcode";
		}	
		elseif(isEmpty($country)) 
		{
			$message .= "Please select Country";
		}
		elseif(isEmpty($cname)) 
		{
			$message .= "Please fill Contact Person";
		}
		elseif(isEmpty($email)) 
		{
			$message .= "Please fill email";
		}
		elseif(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
		{
			$strMessage .= "Provide proper Email";
		}
		elseif(isEmpty($phone)) 
		{
			$message .= "Please fill Phone Number";
		}	
		elseif(isEmpty($category)) 
		{
			$message .= "Please select Category";
		}
		
		if($message == "")
		{
			$image = "";
			$status = "Active";
			
				$sql = sprintf("INSERT INTO %s%s (PublisherId, AccountName, AccountAddress1, AccountCity, AccountState, AccountZipcode, AccountCountry, AccountContactName, AccountEmailId, AccountPhone, InterestHeaderId, PublisherActiveFlag) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", DB_PREFIX, ACCOUNT_TABLE, $pubid, $bname, $address, $city, $state, $zip, $country, $cname, $email, $phone, $category, $status);

				$insert = $db->insertRow($sql);
				
				$acid = $db->getAutoID();
				
				if(isset($_FILES['file']) && !empty($_FILES['file']['name'])) 
				{
					$file_exts = array("jpg", "jpeg", "gif", "png");
				//	$upload_exts = end(explode(".", $_FILES["file"]["name"]));
					if ((($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/png")
					|| ($_FILES["file"]["type"] == "image/pjpeg"))
					&& ($_FILES["file"]["size"] < 5000000))
					{
						if ($_FILES["file"]["error"] > 0)
						{
						$message = "Return Code: " . $_FILES["file"]["error"] . "<br>";
						}
						else
						{
							$filename = $_FILES["file"]["name"];
							$file_ext 		= strtolower(substr($filename, strrpos($filename, '.') + 1));
							$extension = ".".$file_ext;
							$image = $acid.$extension;
							$path = "uploads/publisher/account/" . $image;
							
							move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/publisher/account/" . $image);
							
							$query = sprintf("UPDATE %s%s SET PublisherImage = '%s' WHERE AccountId = '%s'", DB_PREFIX, ACCOUNT_TABLE, $path, $acid);
								
							$row = $db->updateRow($query);
						
						}
					}
					else
					{
						$message = "Invalid file";
					}
				}
				
					//To get number of Active accounts
				/*	$accounts = sprintf("SELECT * FROM %s%s WHERE PublisherId = '%s' AND PublisherActiveFlag='Active'", DB_PREFIX, ACCOUNT_TABLE, $pubid);
					
					$activeaccounts = $db->noOfRows($accounts);
					
					//echo $_SESSION['pubid'];	
					//echo $accounts;
					$query = sprintf("UPDATE %s%s SET PublisherImage = '%s' WHERE AccountId = '%s'", DB_PREFIX, ACCOUNT_TABLE, $path, $acid);			
					$row = $db->updateRow($query);*/
		}
		
	}
	$db->closeConnection();
	
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsear Local Offers</title>
    
    <meta name="description" content="Your City. Your Deals and Events. Welcome to Konsear Local Offers! Konsear Local Offers brings you the best local deals and events in your community." /> 
	<meta name="keywords" content="local offers, coupons, daily deals, groupon, living social, deals, local events, deal of the day, half off deals, half off specials, online coupons, happy hour, wine tasting" /> 
	
	
	<?php include('includes.php'); ?>
	<link rel="stylesheet" href="css/style1.css" type="text/css" media="all">
	<style>
		#change-image { font-size: 0.8em; }
	</style>
	
	<script>
			function changestates(sel) 
			{
		       var country = sel.value;
				  $.ajax({	
					url: "changestates.php", //The url where the server req would we made.
					async: false, 
					type: "POST", //The type which you want to use: GET/POST
					data: "country="+country, //The variables which are going.
					dataType: "html", //Return data type (what we expect).
					
					//This is the function which will be called if ajax call is successful.
					success: function(data) {
						//data is the html of the page where the request is made.
						$('.showstates').html(data);
					}
				})
		    }
		</script>
  </head>
  <body>
	
  <!--<div class="row">
    <div class="medium-3 columns">
      <h1><a href="<?php echo BASE_URL?>"><img src="images/logok.png" /></a></h1>
    </div>
  	<div class="medium-9 columns">
		
		<a href="https://twitter.com/konsear" target="_blank"><img src="images/twit.gif" alt="social links" class="socialnet"/></a> 
		<a href="https://www.facebook.com/#!/Konsear" target="_blank"> <img src="images/facebook.gif" alt="social links" class="socialnet"></a>  
  	</div>
  </div>-->
	<?php include('header.php'); ?>
	<?php include('menu1.php'); ?>
	
	<div class="row">
		<div class="hideinmobile"><?php include('leftbar.php'); ?></div>
	    <div class="medium-6 columns">
			 <form name="register" id="register" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="size" enctype="multipart/form-data" >
				<div class="medium-12 columns bottomspace">
					
					<?php if($message != "") echo "<div class='alert-box success radius'>".$message."</div>"; ?>
					<h3 class="lightgrey">Create Account</h3>
					 
					<div class="medium-5 columns">
						<label class="inline">Account Name</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="bname" id="bname" value="<?php if(isset($bname)) echo stripslashes($bname); ?>"><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Address</label>
					</div>
					<div class="medium-7 columns">
						<textarea name="address" id="address"><?php if(isset($address)) echo stripslashes($address); ?></textarea><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">City</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="city" id="city" value="<?php if(isset($city)) echo stripslashes($city); ?>"><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">State</label>
					</div>
					<div class="medium-7 columns">
						<!--<input type="text" name="state" id="state" value="<?php if(isset($state)) echo stripslashes($state); ?>"><span class="vrequire">*</span>-->
						<div class="showstates">
						<?php
							if(!isset($state))
								$state = "";
							if(isset($country))
							{
								if($country = "US")
									echo states($state).'<span class="vrequire">*</span>';	
								else
									echo '<input type="text" name="state" id="state" value=""><span class="vrequire">*</span>';
							}
							else
							{
									echo states($state).'<span class="vrequire">*</span>';
							}
						?>
						</div>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Zip</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="zip" id="zip" value="<?php if(isset($zip)) echo stripslashes($zip); ?>"><span class="vrequire">*</span>
					</div>
					<div class="medium-5 columns">
						<label class="inline">Country</label>
					</div>
					<div class="medium-7 columns">
						    <?php 
								$sel = 'selected="selected"'; 
								if(!isset($country))
									$country = '';
							?>
    <select id="country" name="country" onchange="changestates(this)">
    <option value=""></option>
    <option value="US" <?PHP if(($country == '') || $country=='US') echo $sel ?>>USA</option>
    <option value="AU" <?PHP if($country=='AU') echo $sel ?>>Australia</option>
    <option value="AF" <?PHP if($country=='AF') echo $sel ?>>Afghanistan</option>
    <option value="AL" <?PHP if($country=='AL') echo $sel ?>>Albania</option>
    <option value="DZ" <?PHP if($country=='DZ') echo $sel ?>>Algeria</option>
    <option value="AS" <?PHP if($country=='AS') echo $sel ?>>American Samoa</option>
    <option value="AD" <?PHP if($country=='AD') echo $sel ?>>Andorra</option>
    <option value="AO" <?PHP if($country=='AO') echo $sel ?>>Angola</option>
    <option value="AI" <?PHP if($country=='AI') echo $sel ?>>Anguilla</option>
    <option value="AQ" <?PHP if($country=='AQ') echo $sel ?>>Antarctica</option>
    <option value="AG" <?PHP if($country=='AG') echo $sel ?>>Antigua &amp; Barbuda</option>
    <option value="AR" <?PHP if($country=='AR') echo $sel ?>>Argentina</option>
    <option value="AM" <?PHP if($country=='AM') echo $sel ?>>Armenia</option>
    <option value="AW" <?PHP if($country=='AW') echo $sel ?>>Aruba</option>
    <option value="AT" <?PHP if($country=='AT') echo $sel ?>>Austria</option>
    <option value="AZ" <?PHP if($country=='AZ') echo $sel ?>>Azerbaijan</option>
    <option value="BS" <?PHP if($country=='BS') echo $sel ?>>Bahamas</option>
    <option value="BH" <?PHP if($country=='BH') echo $sel ?>>Bahrain</option>
    <option value="BD" <?PHP if($country=='BD') echo $sel ?>>Bangladesh</option>
    <option value="BB" <?PHP if($country=='BB') echo $sel ?>>Barbados</option>
    <option value="BY" <?PHP if($country=='BY') echo $sel ?>>Belarus</option>
    <option value="BE" <?PHP if($country=='BE') echo $sel ?>>Belgium</option>
    <option value="BZ" <?PHP if($country=='BZ') echo $sel ?>>Belize</option>
    <option value="BJ" <?PHP if($country=='BJ') echo $sel ?>>Benin</option>
    <option value="BM" <?PHP if($country=='BM') echo $sel ?>>Bermuda</option>
    <option value="BT" <?PHP if($country=='BT') echo $sel ?>>Bhutan</option>
    <option value="BO" <?PHP if($country=='BO') echo $sel ?>>Bolivia</option>
    <option value="BA" <?PHP if($country=='BA') echo $sel ?>>Bosnia/Hercegovina</option>
    <option value="BW" <?PHP if($country=='BW') echo $sel ?>>Botswana</option>
    <option value="BV" <?PHP if($country=='BV') echo $sel ?>>Bouvet Island</option>
    <option value="BR" <?PHP if($country=='BR') echo $sel ?>>Brazil</option>
    <option value="IO" <?PHP if($country=='IO') echo $sel ?>>British Indian Ocean Territory</option>
    <option value="BN" <?PHP if($country=='BN') echo $sel ?>>Brunei Darussalam</option>
    <option value="BG" <?PHP if($country=='BG') echo $sel ?>>Bulgaria</option>
    <option value="BF" <?PHP if($country=='BF') echo $sel ?>>Burkina Faso</option>
    <option value="BI" <?PHP if($country=='BI') echo $sel ?>>Burundi</option>
    <option value="KH" <?PHP if($country=='KH') echo $sel ?>>Cambodia</option>
    <option value="CM" <?PHP if($country=='CM') echo $sel ?>>Cameroon</option>
    <option value="CA" <?PHP if($country=='CA') echo $sel ?>>Canada</option>
    <option value="CV" <?PHP if($country=='CV') echo $sel ?>>Cape Verde</option>
    <option value="KY" <?PHP if($country=='KY') echo $sel ?>>Cayman Is</option>
    <option value="CF" <?PHP if($country=='CF') echo $sel ?>>Central African Republic</option>
    <option value="TD" <?PHP if($country=='TD') echo $sel ?>>Chad</option>
    <option value="CL" <?PHP if($country=='CL') echo $sel ?>>Chile</option>
    <option value="CN" <?PHP if($country=='CN') echo $sel ?>>China, People's Republic of</option>
    <option value="CX" <?PHP if($country=='CX') echo $sel ?>>Christmas Island</option>
    <option value="CC" <?PHP if($country=='CC') echo $sel ?>>Cocos Islands</option>
    <option value="CO" <?PHP if($country=='CO') echo $sel ?>>Colombia</option>
    <option value="KM" <?PHP if($country=='KM') echo $sel ?>>Comoros</option>
    <option value="CG" <?PHP if($country=='CG') echo $sel ?>>Congo</option>
    <option value="CD" <?PHP if($country=='CD') echo $sel ?>>Congo, Democratic Republic</option>
    <option value="CK" <?PHP if($country=='CK') echo $sel ?>>Cook Islands</option>
    <option value="CR" <?PHP if($country=='CR') echo $sel ?>>Costa Rica</option>
    <option value="CI" <?PHP if($country=='CI') echo $sel ?>>Cote d'Ivoire</option>
    <option value="HR" <?PHP if($country=='HR') echo $sel ?>>Croatia</option>
    <option value="CU" <?PHP if($country=='CU') echo $sel ?>>Cuba</option>
    <option value="CY" <?PHP if($country=='CY') echo $sel ?>>Cyprus</option>
    <option value="CZ" <?PHP if($country=='CZ') echo $sel ?>>Czech Republic</option>
    <option value="DK" <?PHP if($country=='DK') echo $sel ?>>Denmark</option>
    <option value="DJ" <?PHP if($country=='DJ') echo $sel ?>>Djibouti</option>
    <option value="DM" <?PHP if($country=='DM') echo $sel ?>>Dominica</option>
    <option value="DO" <?PHP if($country=='DO') echo $sel ?>>Dominican Republic</option>
    <option value="TP" <?PHP if($country=='TP') echo $sel ?>>East Timor</option>
    <option value="EC" <?PHP if($country=='EC') echo $sel ?>>Ecuador</option>
    <option value="EG" <?PHP if($country=='EG') echo $sel ?>>Egypt</option>
    <option value="SV" <?PHP if($country=='SV') echo $sel ?>>El Salvador</option>
    <option value="GQ" <?PHP if($country=='GQ') echo $sel ?>>Equatorial Guinea</option>
    <option value="ER" <?PHP if($country=='ER') echo $sel ?>>Eritrea</option>
    <option value="EE" <?PHP if($country=='EE') echo $sel ?>>Estonia</option>
    <option value="ET" <?PHP if($country=='ET') echo $sel ?>>Ethiopia</option>
    <option value="FK" <?PHP if($country=='FK') echo $sel ?>>Falkland Islands</option>
    <option value="FO" <?PHP if($country=='FO') echo $sel ?>>Faroe Islands</option>
    <option value="FJ" <?PHP if($country=='FJ') echo $sel ?>>Fiji</option>
    <option value="FI" <?PHP if($country=='FI') echo $sel ?>>Finland</option>
    <option value="FR" <?PHP if($country=='FR') echo $sel ?>>France</option>
    <option value="FX" <?PHP if($country=='FX') echo $sel ?>>France, Metropolitan</option>
    <option value="GF" <?PHP if($country=='GF') echo $sel ?>>French Guiana</option>
    <option value="PF" <?PHP if($country=='PF') echo $sel ?>>French Polynesia</option>
    <option value="TF" <?PHP if($country=='TF') echo $sel ?>>French South Territories</option>
    <option value="GA" <?PHP if($country=='GA') echo $sel ?>>Gabon</option>
    <option value="GM" <?PHP if($country=='GM') echo $sel ?>>Gambia</option>
    <option value="GE" <?PHP if($country=='GE') echo $sel ?>>Georgia</option>
    <option value="DE" <?PHP if($country=='DE') echo $sel ?>>Germany</option>
    <option value="GH" <?PHP if($country=='GH') echo $sel ?>>Ghana</option>
    <option value="GI" <?PHP if($country=='GI') echo $sel ?>>Gibraltar</option>
    <option value="GR" <?PHP if($country=='GR') echo $sel ?>>Greece</option>
    <option value="GL" <?PHP if($country=='GL') echo $sel ?>>Greenland</option>
    <option value="GD" <?PHP if($country=='GD') echo $sel ?>>Grenada</option>
    <option value="GP" <?PHP if($country=='GP') echo $sel ?>>Guadeloupe</option>
    <option value="GU" <?PHP if($country=='GU') echo $sel ?>>Guam</option>
    <option value="GT" <?PHP if($country=='GT') echo $sel ?>>Guatemala</option>
    <option value="GN" <?PHP if($country=='GN') echo $sel ?>>Guinea</option>
    <option value="GW" <?PHP if($country=='GW') echo $sel ?>>Guinea-Bissau</option>
    <option value="GY" <?PHP if($country=='GY') echo $sel ?>>Guyana</option>
    <option value="HT" <?PHP if($country=='HT') echo $sel ?>>Haiti</option>
    <option value="HM" <?PHP if($country=='HM') echo $sel ?>>Heard Island And Mcdonald Island</option>
    <option value="HN" <?PHP if($country=='HN') echo $sel ?>>Honduras</option>
    <option value="HK" <?PHP if($country=='HK') echo $sel ?>>Hong Kong</option>
    <option value="HU" <?PHP if($country=='HU') echo $sel ?>>Hungary</option>
    <option value="IS" <?PHP if($country=='IS') echo $sel ?>>Iceland</option>
    <option value="IN" <?PHP if($country=='IN') echo $sel ?>>India</option>
    <option value="ID" <?PHP if($country=='ID') echo $sel ?>>Indonesia</option>
    <option value="IR" <?PHP if($country=='IR') echo $sel ?>>Iran</option>
    <option value="IQ" <?PHP if($country=='IQ') echo $sel ?>>Iraq</option>
    <option value="IE" <?PHP if($country=='IE') echo $sel ?>>Ireland</option>
    <option value="IL" <?PHP if($country=='IL') echo $sel ?>>Israel</option>
    <option value="IT" <?PHP if($country=='IT') echo $sel ?>>Italy</option>
    <option value="JM" <?PHP if($country=='JM') echo $sel ?>>Jamaica</option>
    <option value="JP" <?PHP if($country=='JP') echo $sel ?>>Japan</option>
    <option value="JT" <?PHP if($country=='JT') echo $sel ?>>Johnston Island</option>
    <option value="JO" <?PHP if($country=='JO') echo $sel ?>>Jordan</option>
    <option value="KZ" <?PHP if($country=='KZ') echo $sel ?>>Kazakhstan</option>
    <option value="KE" <?PHP if($country=='KE') echo $sel ?>>Kenya</option>
    <option value="KI" <?PHP if($country=='KI') echo $sel ?>>Kiribati</option>
    <option value="KP" <?PHP if($country=='KP') echo $sel ?>>Korea, Democratic Peoples Republic</option>
    <option value="KR" <?PHP if($country=='KR') echo $sel ?>>Korea, Republic of</option>
    <option value="KW" <?PHP if($country=='KW') echo $sel ?>>Kuwait</option>
    <option value="KG" <?PHP if($country=='KG') echo $sel ?>>Kyrgyzstan</option>
    <option value="LA" <?PHP if($country=='LA') echo $sel ?>>Lao People's Democratic Republic</option>
    <option value="LV" <?PHP if($country=='LV') echo $sel ?>>Latvia</option>
    <option value="LB" <?PHP if($country=='LB') echo $sel ?>>Lebanon</option>
    <option value="LS" <?PHP if($country=='LS') echo $sel ?>>Lesotho</option>
    <option value="LR" <?PHP if($country=='LR') echo $sel ?>>Liberia</option>
    <option value="LY" <?PHP if($country=='LY') echo $sel ?>>Libyan Arab Jamahiriya</option>
    <option value="LI" <?PHP if($country=='LI') echo $sel ?>>Liechtenstein</option>
    <option value="LT" <?PHP if($country=='LT') echo $sel ?>>Lithuania</option>
    <option value="LU" <?PHP if($country=='LU') echo $sel ?>>Luxembourg</option>
    <option value="MO" <?PHP if($country=='MO') echo $sel ?>>Macau</option>
    <option value="MK" <?PHP if($country=='MK') echo $sel ?>>Macedonia</option>
    <option value="MG" <?PHP if($country=='MG') echo $sel ?>>Madagascar</option>
    <option value="MW" <?PHP if($country=='MW') echo $sel ?>>Malawi</option>
    <option value="MY" <?PHP if($country=='MY') echo $sel ?>>Malaysia</option>
    <option value="MV" <?PHP if($country=='MV') echo $sel ?>>Maldives</option>
    <option value="ML" <?PHP if($country=='ML') echo $sel ?>>Mali</option>
    <option value="MT" <?PHP if($country=='MT') echo $sel ?>>Malta</option>
    <option value="MH" <?PHP if($country=='MH') echo $sel ?>>Marshall Islands</option>
    <option value="MQ" <?PHP if($country=='MQ') echo $sel ?>>Martinique</option>
    <option value="MR" <?PHP if($country=='MR') echo $sel ?>>Mauritania</option>
    <option value="MU" <?PHP if($country=='MU') echo $sel ?>>Mauritius</option>
    <option value="YT" <?PHP if($country=='YT') echo $sel ?>>Mayotte</option>
    <option value="MX" <?PHP if($country=='MX') echo $sel ?>>Mexico</option>
    <option value="FM" <?PHP if($country=='FM') echo $sel ?>>Micronesia</option>
    <option value="MD" <?PHP if($country=='MD') echo $sel ?>>Moldavia</option>
    <option value="MC" <?PHP if($country=='MC') echo $sel ?>>Monaco</option>
    <option value="MN" <?PHP if($country=='MN') echo $sel ?>>Mongolia</option>
    <option value="MS" <?PHP if($country=='MS') echo $sel ?>>Montserrat</option>
    <option value="MA" <?PHP if($country=='MA') echo $sel ?>>Morocco</option>
    <option value="MZ" <?PHP if($country=='MZ') echo $sel ?>>Mozambique</option>
    <option value="MM" <?PHP if($country=='MM') echo $sel ?>>Union Of Myanmar</option>
    <option value="NA" <?PHP if($country=='NA') echo $sel ?>>Namibia</option>
    <option value="NR" <?PHP if($country=='NR') echo $sel ?>>Nauru Island</option>
    <option value="NP" <?PHP if($country=='NP') echo $sel ?>>Nepal</option>
    <option value="NL" <?PHP if($country=='NL') echo $sel ?>>Netherlands</option>
    <option value="AN" <?PHP if($country=='AN') echo $sel ?>>Netherlands Antilles</option>
    <option value="NC" <?PHP if($country=='NC') echo $sel ?>>New Caledonia</option>
    <option value="NZ" <?PHP if($country=='NZ') echo $sel ?>>New Zealand</option>
    <option value="NI" <?PHP if($country=='NI') echo $sel ?>>Nicaragua</option>
    <option value="NE" <?PHP if($country=='NE') echo $sel ?>>Niger</option>
    <option value="NG" <?PHP if($country=='NG') echo $sel ?>>Nigeria</option>
    <option value="NU" <?PHP if($country=='NU') echo $sel ?>>Niue</option>
    <option value="NF" <?PHP if($country=='NF') echo $sel ?>>Norfolk Island</option>
    <option value="MP" <?PHP if($country=='MP') echo $sel ?>>Mariana Islands, Northern</option>
    <option value="NO" <?PHP if($country=='NO') echo $sel ?>>Norway</option>
    <option value="OM" <?PHP if($country=='OM') echo $sel ?>>Oman</option>
    <option value="PK" <?PHP if($country=='PK') echo $sel ?>>Pakistan</option>
    <option value="PW" <?PHP if($country=='PW') echo $sel ?>>Palau Islands</option>
    <option value="PS" <?PHP if($country=='PS') echo $sel ?>>Palestine</option>
    <option value="PA" <?PHP if($country=='PA') echo $sel ?>>Panama</option>
    <option value="PG" <?PHP if($country=='PG') echo $sel ?>>Papua New Guinea</option>
    <option value="PY" <?PHP if($country=='PY') echo $sel ?>>Paraguay</option>
    <option value="PE" <?PHP if($country=='PE') echo $sel ?>>Peru</option>
    <option value="PH" <?PHP if($country=='PH') echo $sel ?>>Philippines</option>
    <option value="PN" <?PHP if($country=='PN') echo $sel ?>>Pitcairn</option>
    <option value="PL" <?PHP if($country=='PL') echo $sel ?>>Poland</option>
    <option value="PT" <?PHP if($country=='PT') echo $sel ?>>Portugal</option>
    <option value="PR" <?PHP if($country=='PR') echo $sel ?>>Puerto Rico</option>
    <option value="QA" <?PHP if($country=='QA') echo $sel ?>>Qatar</option>
    <option value="RE" <?PHP if($country=='RE') echo $sel ?>>Reunion Island</option>
    <option value="RO" <?PHP if($country=='RO') echo $sel ?>>Romania</option>
    <option value="RU" <?PHP if($country=='RU') echo $sel ?>>Russian Federation</option>
    <option value="RW" <?PHP if($country=='RW') echo $sel ?>>Rwanda</option>
    <option value="WS" <?PHP if($country=='WS') echo $sel ?>>Samoa</option>
    <option value="SH" <?PHP if($country=='SH') echo $sel ?>>St Helena</option>
    <option value="KN" <?PHP if($country=='KN') echo $sel ?>>St Kitts &amp; Nevis</option>
    <option value="LC" <?PHP if($country=='LC') echo $sel ?>>St Lucia</option>
    <option value="PM" <?PHP if($country=='PM') echo $sel ?>>St Pierre &amp; Miquelon</option>
    <option value="VC" <?PHP if($country=='VC') echo $sel ?>>St Vincent</option>
    <option value="SM" <?PHP if($country=='SM') echo $sel ?>>San Marino</option>
    <option value="ST" <?PHP if($country=='ST') echo $sel ?>>Sao Tome &amp; Principe</option>
    <option value="SA" <?PHP if($country=='SA') echo $sel ?>>Saudi Arabia</option>
    <option value="SN" <?PHP if($country=='SN') echo $sel ?>>Senegal</option>
    <option value="SC" <?PHP if($country=='SC') echo $sel ?>>Seychelles</option>
    <option value="SL" <?PHP if($country=='SL') echo $sel ?>>Sierra Leone</option>
    <option value="SG" <?PHP if($country=='SG') echo $sel ?>>Singapore</option>
    <option value="SK" <?PHP if($country=='SK') echo $sel ?>>Slovakia</option>
    <option value="SI" <?PHP if($country=='SI') echo $sel ?>>Slovenia</option>
    <option value="SB" <?PHP if($country=='SB') echo $sel ?>>Solomon Islands</option>
    <option value="SO" <?PHP if($country=='SO') echo $sel ?>>Somalia</option>
    <option value="ZA" <?PHP if($country=='ZA') echo $sel ?>>South Africa</option>
    <option value="GS" <?PHP if($country=='GS') echo $sel ?>>South Georgia and South Sandwich</option>
    <option value="ES" <?PHP if($country=='ES') echo $sel ?>>Spain</option>
    <option value="LK" <?PHP if($country=='LK') echo $sel ?>>Sri Lanka</option>
    <option value="XX" <?PHP if($country=='XX') echo $sel ?>>Stateless Persons</option>
    <option value="SD" <?PHP if($country=='SD') echo $sel ?>>Sudan</option>
    <option value="SR" <?PHP if($country=='SR') echo $sel ?>>Suriname</option>
    <option value="SJ" <?PHP if($country=='SJ') echo $sel ?>>Svalbard and Jan Mayen</option>
    <option value="SZ" <?PHP if($country=='SZ') echo $sel ?>>Swaziland</option>
    <option value="SE" <?PHP if($country=='SE') echo $sel ?>>Sweden</option>
    <option value="CH" <?PHP if($country=='CH') echo $sel ?>>Switzerland</option>
    <option value="SY" <?PHP if($country=='SY') echo $sel ?>>Syrian Arab Republic</option>
    <option value="TW" <?PHP if($country=='TW') echo $sel ?>>Taiwan, Republic of China</option>
    <option value="TJ" <?PHP if($country=='TJ') echo $sel ?>>Tajikistan</option>
    <option value="TZ" <?PHP if($country=='TZ') echo $sel ?>>Tanzania</option>
    <option value="TH" <?PHP if($country=='TH') echo $sel ?>>Thailand</option>
    <option value="TL" <?PHP if($country=='TL') echo $sel ?>>Timor Leste</option>
    <option value="TG" <?PHP if($country=='TG') echo $sel ?>>Togo</option>
    <option value="TK" <?PHP if($country=='TK') echo $sel ?>>Tokelau</option>
    <option value="TO" <?PHP if($country=='TO') echo $sel ?>>Tonga</option>
    <option value="TT" <?PHP if($country=='TT') echo $sel ?>>Trinidad &amp; Tobago</option>
    <option value="TN" <?PHP if($country=='TN') echo $sel ?>>Tunisia</option>
    <option value="TR" <?PHP if($country=='TR') echo $sel ?>>Turkey</option>
    <option value="TM" <?PHP if($country=='TM') echo $sel ?>>Turkmenistan</option>
    <option value="TC" <?PHP if($country=='TC') echo $sel ?>>Turks And Caicos Islands</option>
    <option value="TV" <?PHP if($country=='TV') echo $sel ?>>Tuvalu</option>
    <option value="UG" <?PHP if($country=='UG') echo $sel ?>>Uganda</option>
    <option value="UA" <?PHP if($country=='UA') echo $sel ?>>Ukraine</option>
    <option value="AE" <?PHP if($country=='AE') echo $sel ?>>United Arab Emirates</option>
    <option value="GB" <?PHP if($country=='GB') echo $sel ?>>United Kingdom</option>
    <option value="UM" <?PHP if($country=='UM') echo $sel ?>>US Minor Outlying Islands</option>
    <option value="HV" <?PHP if($country=='HV') echo $sel ?>>Upper Volta</option>
    <option value="UY" <?PHP if($country=='UY') echo $sel ?>>Uruguay</option>
    <option value="UZ" <?PHP if($country=='UZ') echo $sel ?>>Uzbekistan</option>
    <option value="VU" <?PHP if($country=='VU') echo $sel ?>>Vanuatu</option>
    <option value="VA" <?PHP if($country=='VA') echo $sel ?>>Vatican City State</option>
    <option value="VE" <?PHP if($country=='VE') echo $sel ?>>Venezuela</option>
    <option value="VN" <?PHP if($country=='VN') echo $sel ?>>Vietnam</option>
    <option value="VG" <?PHP if($country=='VG') echo $sel ?>>Virgin Islands (British)</option>
    <option value="VI" <?PHP if($country=='VI') echo $sel ?>>Virgin Islands (US)</option>
    <option value="WF" <?PHP if($country=='WF') echo $sel ?>>Wallis And Futuna Islands</option>
    <option value="EH" <?PHP if($country=='EH') echo $sel ?>>Western Sahara</option>
    <option value="YE" <?PHP if($country=='YE') echo $sel ?>>Yemen Arab Rep.</option>
    <option value="YD" <?PHP if($country=='YD') echo $sel ?>>Yemen Democratic</option>
    <option value="YU" <?PHP if($country=='YU') echo $sel ?>>Yugoslavia</option>
    <option value="ZR" <?PHP if($country=='ZR') echo $sel ?>>Zaire</option>
    <option value="ZM" <?PHP if($country=='ZM') echo $sel ?>>Zambia</option>
    <option value="ZW" <?PHP if($country=='ZW') echo $sel ?>>Zimbabwe</option>
    </select><span class="vrequire">*</span>
					</div>
					
					<div class="medium-5 columns">
						<label class="inline">Contact Person</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="cname" id="cname" value="<?php if(isset($cname)) echo stripslashes($cname); ?>"><span class="vrequire">*</span>
					</div>	
					<div class="medium-5 columns">
						<label class="inline">Email</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="email" id="email" value="<?php if(isset($email)) echo stripslashes($email); ?>"><span class="vrequire">*</span>
					</div>	
					<div class="medium-5 columns">
						<label class="inline">Phone</label>
					</div>
					<div class="medium-7 columns">
						<input type="text" name="phone" id="phone" value="<?php if(isset($phone)) echo stripslashes($phone); ?>"><span class="vrequire">*</span>
					</div>			
					<div class="medium-5 columns">
						<label class="inline">Category</label>
					</div>
					<div class="medium-7 columns">
						<select name="category" id="category">
							<?
								$db = new VDatabase(true);
								
								$query2 = sprintf("SELECT InterestHeaderId, InterestHeaderName FROM %s%s", DB_PREFIX, INTERESTHEADER_TABLE);
								echo fillDropdown($query2, (isset($category) ? $category : ''));
								
								$db->closeConnection();
							?></select><span class="vrequire">*</span>
							
						</select>
					</div>	
					<div class="medium-5 columns">
						<label class="inline">Business Logo</label>
					</div>
					<div class="medium-7 columns">
						<input type="file" name="file" id="file" value="">
					</div>
					<div class="medium-12 columns">&nbsp;</div>
					<div class="medium-7 columns">
						<div align="center">
							<input type="submit" name="submit" value="Create" class="tiny button radius">
						</div>
					</div>
				</div>
			</form>
		</div> 
		<div class="showinmobile"><?php include('leftbar.php'); ?></div>
		<?php include('rightbar.php'); ?>
	</div>
 

  <!-- Footer -->
	<?php include('footer1.php'); ?>

    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>