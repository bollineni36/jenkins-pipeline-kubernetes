<?PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);
	define('LOCAL', FALSE);

	//to convert default date to Dubai Time Zone
//	date_default_timezone_set('Asia/Kolkata'); 


	//IF LOCAL SET TO TRUE USE THE FOLLOWING TEST DB SETTINGS

	if (LOCAL) {

		define('DB_HOST', 'localhost');

		define('DB_USER', 'root');

		define('DB_PWD', '');

		define('DB_NAME', 'konsear');

	} else {
		
		//IF LOCAL SET TO FALSE USE THE FOLLOWING LIVE DB SETTINGS
		define('DB_HOST', 'testmysql');

		define('DB_USER', 'konsear');

		define('DB_PWD', 'Thanks@5366');

		define('DB_NAME', 'konsear_db_stage');

	}


 	define('BASE_URL', LOCAL ? 'http://localhost/konsear_ncinc/' : 'http://20.42.24.16/');


?>
