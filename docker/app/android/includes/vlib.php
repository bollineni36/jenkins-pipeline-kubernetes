<?php

function fillDropdown($query, $defaultValue = NULL) {

	$options = '';
	
	$db = new VDatabase(true);
	
	$rows = $db->getRows($query);
	
	$db->closeConnection();
	
	foreach($rows as $row) {
		
		$options .= '<option value="' . $row[0] . '"' . ($defaultValue == $row[0] ? ' selected="selected"' : '') .  '>' . $row[1] . '</option>';	
		
	}
	
	return $options;

}

	
	
function states($defaultValue = NULL)
	{
		$states = '
		<select name="state" id="state">
			<option value="">Select State</option>
			<option value="AL" '.($defaultValue == "AL" ? 'selected="selected"' : '').'>Alabama</option> 
			<option value="AK" '.($defaultValue == "AK" ? 'selected="selected"' : '').'>Alaska</option> 
			<option value="AZ" '.($defaultValue == "AZ" ? 'selected="selected"' : '').'>Arizona</option> 
			<option value="AR" '.($defaultValue == "AR" ? 'selected="selected"' : '').'>Arkansas</option> 
			<option value="CA" '.($defaultValue == "CA" ? 'selected="selected"' : '').'>California</option> 
			<option value="CO" '.($defaultValue == "CO" ? 'selected="selected"' : '').'>Colorado</option> 
			<option value="CT" '.($defaultValue == "CT" ? 'selected="selected"' : '').'>Connecticut</option> 
			<option value="DE" '.($defaultValue == "DE" ? 'selected="selected"' : '').'>Delaware</option> 
			<option value="FL" '.($defaultValue == "FL" ? 'selected="selected"' : '').'>Florida</option> 
			<option value="GA" '.($defaultValue == "GA" ? 'selected="selected"' : '').'>Georgia</option> 
			<option value="HI" '.($defaultValue == "HI" ? 'selected="selected"' : '').'>Hawaii</option> 
			<option value="ID" '.($defaultValue == "ID" ? 'selected="selected"' : '').'>Idaho</option> 
			<option value="IL" '.($defaultValue == "IL" ? 'selected="selected"' : '').'>Illinois</option> 
			<option value="IN" '.($defaultValue == "IN" ? 'selected="selected"' : '').'>Indiana</option> 
			<option value="IA" '.($defaultValue == "IA" ? 'selected="selected"' : '').'>Iowa</option> 
			<option value="KS" '.($defaultValue == "KS" ? 'selected="selected"' : '').'>Kansas</option> 
			<option value="KY" '.($defaultValue == "KY" ? 'selected="selected"' : '').'>Kentucky</option> 
			<option value="LA" '.($defaultValue == "LA" ? 'selected="selected"' : '').'>Louisiana</option> 
			<option value="ME" '.($defaultValue == "ME" ? 'selected="selected"' : '').'>Maine</option> 
			<option value="MD" '.($defaultValue == "MD" ? 'selected="selected"' : '').'>Maryland</option> 
			<option value="MA" '.($defaultValue == "MA" ? 'selected="selected"' : '').'>Massachusetts</option> 
			<option value="MI" '.($defaultValue == "MI" ? 'selected="selected"' : '').'>Michigan</option> 
			<option value="MN" '.($defaultValue == "MN" ? 'selected="selected"' : '').'>Minnesota</option> 
			<option value="MS" '.($defaultValue == "MS" ? 'selected="selected"' : '').'>Mississippi</option> 
			<option value="MO" '.($defaultValue == "MO" ? 'selected="selected"' : '').'>Missouri</option> 
			<option value="MT" '.($defaultValue == "MT" ? 'selected="selected"' : '').'>Montana</option> 
			<option value="NE" '.($defaultValue == "NE" ? 'selected="selected"' : '').'>Nebraska</option> 
			<option value="NV" '.($defaultValue == "NV" ? 'selected="selected"' : '').'>Nevada</option> 
			<option value="NH" '.($defaultValue == "NH" ? 'selected="selected"' : '').'>New Hampshire</option> 
			<option value="NJ" '.($defaultValue == "NJ" ? 'selected="selected"' : '').'>New Jersey</option> 
			<option value="NM" '.($defaultValue == "NM" ? 'selected="selected"' : '').'>New Mexico</option> 
			<option value="NY" '.($defaultValue == "NY" ? 'selected="selected"' : '').'>New York</option> 
			<option value="NC" '.($defaultValue == "NC" ? 'selected="selected"' : '').'>North Carolina</option> 
			<option value="ND" '.($defaultValue == "ND" ? 'selected="selected"' : '').'>North Dakota</option> 
			<option value="OH" '.($defaultValue == "OH" ? 'selected="selected"' : '').'>Ohio</option> 
			<option value="OK" '.($defaultValue == "OK" ? 'selected="selected"' : '').'>Oklahoma</option> 
			<option value="OR" '.($defaultValue == "OR" ? 'selected="selected"' : '').'>Oregon</option> 
			<option value="PA" '.($defaultValue == "PA" ? 'selected="selected"' : '').'>Pennsylvania</option> 
			<option value="RI" '.($defaultValue == "RI" ? 'selected="selected"' : '').'>Rhode Island</option> 
			<option value="SC" '.($defaultValue == "SC" ? 'selected="selected"' : '').'>South Carolina</option> 
			<option value="SD" '.($defaultValue == "SD" ? 'selected="selected"' : '').'>South Dakota</option> 
			<option value="TN" '.($defaultValue == "TN" ? 'selected="selected"' : '').'>Tennessee</option> 
			<option value="TX" '.($defaultValue == "TX" ? 'selected="selected"' : '').'>Texas</option> 
			<option value="UT" '.($defaultValue == "UT" ? 'selected="selected"' : '').'>Utah</option> 
			<option value="VT" '.($defaultValue == "VT" ? 'selected="selected"' : '').'>Vermont</option> 
			<option value="VA" '.($defaultValue == "VA" ? 'selected="selected"' : '').'>Virginia</option> 
			<option value="WA" '.($defaultValue == "WA" ? 'selected="selected"' : '').'>Washington</option> 
			<option value="WV" '.($defaultValue == "WV" ? 'selected="selected"' : '').'>West Virginia</option> 
			<option value="WI" '.($defaultValue == "WI" ? 'selected="selected"' : '').'>Wisconsin</option> 
			<option value="WY" '.($defaultValue == "WY" ? 'selected="selected"' : '').'>Wyoming</option> 
		</select>';
		return $states;
	}
	
?>

