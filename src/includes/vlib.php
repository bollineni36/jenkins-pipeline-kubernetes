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
			<option value="Alabama" '.($defaultValue == "Alabama" ? 'selected="selected"' : '').'>Alabama</option> 
			<option value="Alaska" '.($defaultValue == "Alaska" ? 'selected="selected"' : '').'>Alaska</option> 
			<option value="Arizona" '.($defaultValue == "Arizona" ? 'selected="selected"' : '').'>Arizona</option> 
			<option value="Arkansas" '.($defaultValue == "Arkansas" ? 'selected="selected"' : '').'>Arkansas</option> 
			<option value="California" '.($defaultValue == "California" ? 'selected="selected"' : '').'>California</option> 
			<option value="Colorado" '.($defaultValue == "Colorado" ? 'selected="selected"' : '').'>Colorado</option> 
			<option value="Connecticut" '.($defaultValue == "Connecticut" ? 'selected="selected"' : '').'>Connecticut</option> 
			<option value="Delaware" '.($defaultValue == "Delaware" ? 'selected="selected"' : '').'>Delaware</option> 
			<option value="Florida" '.($defaultValue == "Florida" ? 'selected="selected"' : '').'>Florida</option> 
			<option value="Georgia" '.($defaultValue == "Georgia" ? 'selected="selected"' : '').'>Georgia</option> 
			<option value="Hawaii" '.($defaultValue == "Hawaii" ? 'selected="selected"' : '').'>Hawaii</option> 
			<option value="Idaho" '.($defaultValue == "Idaho" ? 'selected="selected"' : '').'>Idaho</option> 
			<option value="Illinois" '.($defaultValue == "Illinois" ? 'selected="selected"' : '').'>Illinois</option> 
			<option value="Indiana" '.($defaultValue == "Indiana" ? 'selected="selected"' : '').'>Indiana</option> 
			<option value="Iowa" '.($defaultValue == "Iowa" ? 'selected="selected"' : '').'>Iowa</option> 
			<option value="Kansas" '.($defaultValue == "Kansas" ? 'selected="selected"' : '').'>Kansas</option> 
			<option value="Kentucky" '.($defaultValue == "Kentucky" ? 'selected="selected"' : '').'>Kentucky</option> 
			<option value="Louisiana" '.($defaultValue == "Louisiana" ? 'selected="selected"' : '').'>Louisiana</option> 
			<option value="Maine" '.($defaultValue == "Maine" ? 'selected="selected"' : '').'>Maine</option> 
			<option value="Maryland" '.($defaultValue == "Maryland" ? 'selected="selected"' : '').'>Maryland</option> 
			<option value="Massachusetts" '.($defaultValue == "Massachusetts" ? 'selected="selected"' : '').'>Massachusetts</option> 
			<option value="Michigan" '.($defaultValue == "Michigan" ? 'selected="selected"' : '').'>Michigan</option> 
			<option value="Minnesota" '.($defaultValue == "Minnesota" ? 'selected="selected"' : '').'>Minnesota</option> 
			<option value="Mississippi" '.($defaultValue == "Mississippi" ? 'selected="selected"' : '').'>Mississippi</option> 
			<option value="Missouri" '.($defaultValue == "Missouri" ? 'selected="selected"' : '').'>Missouri</option> 
			<option value="Montana" '.($defaultValue == "Montana" ? 'selected="selected"' : '').'>Montana</option> 
			<option value="Nebraska" '.($defaultValue == "Nebraska" ? 'selected="selected"' : '').'>Nebraska</option> 
			<option value="Nevada" '.($defaultValue == "Nevada" ? 'selected="selected"' : '').'>Nevada</option> 
			<option value="New Hampshire" '.($defaultValue == "New Hampshire" ? 'selected="selected"' : '').'>New Hampshire</option> 
			<option value="New Jersey" '.($defaultValue == "New Jersey" ? 'selected="selected"' : '').'>New Jersey</option> 
			<option value="New Mexico" '.($defaultValue == "New Mexico" ? 'selected="selected"' : '').'>New Mexico</option> 
			<option value="New York" '.($defaultValue == "New York" ? 'selected="selected"' : '').'>New York</option> 
			<option value="North Carolina" '.($defaultValue == "North Carolina" ? 'selected="selected"' : '').'>North Carolina</option> 
			<option value="North Dakota" '.($defaultValue == "North Dakota" ? 'selected="selected"' : '').'>North Dakota</option> 
			<option value="Ohio" '.($defaultValue == "Ohio" ? 'selected="selected"' : '').'>Ohio</option> 
			<option value="Oklahoma" '.($defaultValue == "Oklahoma" ? 'selected="selected"' : '').'>Oklahoma</option> 
			<option value="Oregon" '.($defaultValue == "Oregon" ? 'selected="selected"' : '').'>Oregon</option> 
			<option value="Pennsylvania" '.($defaultValue == "Pennsylvania" ? 'selected="selected"' : '').'>Pennsylvania</option> 
			<option value="Rhode Island" '.($defaultValue == "Rhode Island" ? 'selected="selected"' : '').'>Rhode Island</option> 
			<option value="South Carolina" '.($defaultValue == "South Carolina" ? 'selected="selected"' : '').'>South Carolina</option> 
			<option value="South Dakota" '.($defaultValue == "South Dakota" ? 'selected="selected"' : '').'>South Dakota</option> 
			<option value="Tennessee" '.($defaultValue == "Tennessee" ? 'selected="selected"' : '').'>Tennessee</option> 
			<option value="Texas" '.($defaultValue == "Texas" ? 'selected="selected"' : '').'>Texas</option> 
			<option value="Utah" '.($defaultValue == "Utah" ? 'selected="selected"' : '').'>Utah</option> 
			<option value="Vermont" '.($defaultValue == "Vermont" ? 'selected="selected"' : '').'>Vermont</option> 
			<option value="Virginia" '.($defaultValue == "Virginia" ? 'selected="selected"' : '').'>Virginia</option> 
			<option value="Washington" '.($defaultValue == "Washington" ? 'selected="selected"' : '').'>Washington</option> 
			<option value="West Virginia" '.($defaultValue == "West Virginia" ? 'selected="selected"' : '').'>West Virginia</option> 
			<option value="Wisconsin" '.($defaultValue == "Wisconsin" ? 'selected="selected"' : '').'>Wisconsin</option> 
			<option value="Wyoming" '.($defaultValue == "Wyoming" ? 'selected="selected"' : '').'>Wyoming</option> 
		</select>';
		return $states;
	}
	
?>

