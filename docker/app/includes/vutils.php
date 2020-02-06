<?PHP

function redirectPage($page) {
	header('Location: ' . BASE_URL . $page);
	exit;
}

function escapeSql($input) {
	return mysql_real_escape_string($input);
}


function destroySession() {
	session_start();

	$_SESSION = array();
	
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	
	session_destroy();
}
function generateRandomString($length = 6) {
    return substr(str_shuffle("23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ"), 0, $length);
}
function encrypt2Way($input) {
		$password = ENCRYPTION_KEY;
		$iv_len = 8;
		$input .= "\x13";
		$n = strlen($input);
		if ($n % 8) $input .= str_repeat("\0", 8 - ($n % 8));
		$i = 0;
		//$enc_text = getRandomIV($iv_len);
		$enc_text = "krishnas";
		$iv = substr($password ^ $enc_text, 0, 512);
		while ($i < $n) {
		   $block = substr($input, $i, 8) ^ pack('H*', md5($iv));
		   $enc_text .= $block;
		   $iv = substr($block . $iv, 0, 512) ^ $password;
		   $i += 8;
		}
		return base64_encode($enc_text);
	}


	function decrypt($input) {
		$password = ENCRYPTION_KEY;
		$iv_len = 8;
		$input = base64_decode($input);
		$n = strlen($input);
		$i = $iv_len;
		$plain_text = '';
		$iv = substr($password ^ substr($input, 0, $iv_len), 0, 512);
		while ($i < $n) {
		   $block = substr($input, $i, 8);
		   $plain_text .= $block ^ pack('H*', md5($iv));
		   $iv = substr($block . $iv, 0, 512) ^ $password;
		   $i += 8;
		}
		return preg_replace('/\\x13\\x00*$/', '', $plain_text);
	}

// Date should be in DD/MM/YYYY format
function XLSconvertDateToDBFormat($inputDate, $withTime = false) {
	if($withTime == true) {
		$parts = explode(' ', $inputDate);
		$time = count($parts) == 2 ? (' ' . $parts[1]) : '';
		$parts = explode('/', $parts[0]);
		
		return $parts[2] . '-' . $parts[1] . '-' . $parts[0] . ' ' . $time;
		//return $parts[2] . '-' . $parts[0] . '-' . $parts[1] . ' ' . $time;
	} else {
		$parts = explode('/', $inputDate);
		return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
		//return $parts[2] . '-' . $parts[0] . '-' . $parts[1];		
	}
}

// Date should be in DD/MM/YYYY format
function convertDateToDBFormat($inputDate, $withTime = false) {
	if($withTime == true) {
		$parts = explode(' ', $inputDate);
		$time = count($parts) == 2 ? (' ' . $parts[1]) : '';
		$parts = explode('/', $parts[0]);
		
		return $parts[2] . '-' . $parts[0] . '-' . $parts[1] . ' ' . $time;
	} else {
		$parts = explode('/', $inputDate);
		return $parts[2] . '-' . $parts[0] . '-' . $parts[1];	
	}
}

// Date should be in DD/MM/YYYY format
	function toDBFormat($inputDate, $withTime = false) {
		if($withTime == true) {
			$parts = explode(' ', $inputDate);
			$time = count($parts) == 2 ? (' ' . $parts[1]) : '';
			$parts = explode('/', $parts[0]);
			
			return $parts[2] . '-' . $parts[0] . '-' . $parts[1] . ' ' . $time;
		} else {
			$parts = explode('/', $inputDate);
			return $parts[2] . '-' . $parts[0] . '-' . $parts[1];	
		}
	}

	// Date should be in MM-DD-YYYY HH:mm:ss format
	function toUSFormat($inputDate, $withTime = true) {
		$parts = explode(' ', $inputDate);
		$time = count($parts) == 2 ? (' ' . $parts[1]) : '';
		$parts = explode('-', $parts[0]);
		
		if($withTime) {
			return $parts[1] . '/' . $parts[2] . '/' . $parts[0] . $time;
		} else {
			return $parts[1] . '/' . $parts[2] . '/' . $parts[0];
		}
	}


function sendEmail($from, $to, $subject, $body) {
	if (LOCAL) {
		return true;	
	}
	$optional = "-f".$from;
	$mailheaders = "MIME-Version: 1.0\n";
	$mailheaders .= "Content-type: text/html; charset=iso-8859-1\n";
	$mailheaders .= "X-Priority: 3\n";
	$mailheaders .= "X-MSMail-Priority: Normal\n";
	$mailheaders .= "X-Mailer: php\n";
	$mailheaders .= "From: <$from>\n";
	$mailheaders .= "Reply-to: <$from>\n";
	$mailheaders .= "Return-path: <$from>\n";
	
	return mail($to, $subject, $body, $mailheaders, $optional);
}

function contactEmail($from, $to, $subject, $body) {
	if (LOCAL) {
		return true;	
	}
	
	$optional = "-f".$from;
	$mailheaders = "MIME-Version: 1.0\n";
	$mailheaders .= "Content-type: text/html; charset=iso-8859-1\n";
	$mailheaders .= "X-Priority: 3\n";
	$mailheaders .= "X-MSMail-Priority: Normal\n";
	$mailheaders .= "X-Mailer: php\n";
	$mailheaders .= "From: <$from>\n";
	$mailheaders .= "Reply-to: <donotreply@konsear.com>\n";
	$mailheaders .= "Return-path: <donotreply@konsear.com>\n";
	
	return mail($to, $subject, $body, $mailheaders, $optional);
}

function addScheme($url, $scheme = 'http://')
{
  return parse_url($url, PHP_URL_SCHEME) === null ? $scheme . $url : $url;
}

?>
