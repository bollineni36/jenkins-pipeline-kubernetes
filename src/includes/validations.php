<?php

	function isEmpty($input) {
	
		if($input == '' || $input == NULL) {
		
			return true;
			
		}
		
		return false;
		
	}

	function isRadioEmpty($input) {
	
		if(strlen($input) == 0) {
		
			return true;
			
		}
		
		return false;
		
	}
	
	
	function isValidEmail($input) {
	
		if (preg_match("/^[0-9a-z]+(([\.\-_])[0-9a-z]+)*@[0-9a-z]+(([\.\-])[0-9a-z-]+)*\.[a-z]{2,4}$/i"
						, strtolower($input))) {
						
				return true;
				
		} else {
			
				return false;
				
		}
		
	}

	
	function isValidNumber($input, $length) {
	
		$pattern = ($length == 0) ? "/^[0-9]*$/" : "/^[0-9]{0,".$length."}$/";

		if (preg_match($pattern, $input)) {
		
			return true;
			
		} else {
		
			return false;
			
		}
		
	}
	
	
	// Date in DD/MM/YYYY Format
	function isValidDate($input) {
	
		$parts = explode("/", $input);
		
		$dd = $parts[0];
		
		$mm = $parts[1];
		
		$parts = explode(" ", $parts[2]);
		
		$yyyy = $parts[0];
		
		
		if($dd <= 0 || $mm <= 0 || $yyyy <= 0) {
		
			return false;
		
		}
		
		if(($yyyy % 4 == 0 && $mm == 2 && $dd > 29)
			|| ($yyyy % 4 != 0 && $mm == 2 && $dd > 28)
			|| (($mm == 4 || $mm == 6 || $mm == 9 || $mm == 11) && $dd > 30)
			|| (($mm == 1 || $mm == 3 || $mm == 5 || $mm == 7 || $mm == 8 || $mm == 10 || $mm == 12) && $dd > 31)) {
		
			return false;
		
		} 
	
		return true;
		
	}
	
	
	function isGreaterDate($start_date, $end_date) {
	
		$start = strtotime($start_date);
		
		$end = strtotime($end_date);
		
		if ($start-$end > 0) {
		
			return false;
			
		}
		else {
		
			return true;
		
		}
		
	}
	
?>
