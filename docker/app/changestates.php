<?php
require_once("includes/vlib.php");

$countryname = $_POST['country'];

if($countryname == "US")
	echo states().'<span class="vrequire">*</span>';
else
	echo '<input type="text" name="state" id="state" value=""><span class="vrequire">*</span>';
?>