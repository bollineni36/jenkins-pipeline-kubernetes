<?php

class VDatabase {
	
	var $dbLink=NULL;
	
	
	function VDatabase($openPrimaryDB = false) {
		if ($openPrimaryDB) {
			$this->openConnection(DB_HOST, DB_USER, DB_PWD, DB_NAME);
		}
	}
	
	
	function getDBLink() {
		return $this->dbLink;
	}
	
	function openConnection($hostName, $userName, $pwd, $dbName) {
		//$this->dbLink = mysqli_connect($hostName, $userName, $pwd) or die($_SESSION['errMsg'] = "Could not Connect to the DATABASE"); 
		//mysqli_select_db($dbName, $this->dbLink) or die($_SESSION['errMsg']="Could not select the DATABASE");
		
		// Create connection
		$this->dbLink = mysqli_connect($hostName, $userName, $pwd, $dbName);
		// Check connection
		if (!$this->dbLink) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		
		
	}
	
	
	function closeConnection() {
		if ($this->dbLink != null) {		
			mysqli_close($this->dbLink);
		}
	}
	
	
	function begin() {
		if ($this->dbLink != null) {
			//mysqli_query('BEGIN');
			mysqli_begin_transaction($link, MYSQLI_TRANS_START_READ_ONLY);
		}
	}
	
	
	function commit() {
		if ($this->dbLink != null) {
			//mysqli_query('COMMIT');
			mysqli_commit($this->dbLink);
		}
	}
	
	
	function rollback() {
		if ($this->dbLink != null) {
			//mysqli_query('ROLLBACK');
			mysqli_rollback($this->dbLink);
		}
	}
	
	function escapeString($string) {
		return mysqli_real_escape_string($this->dbLink, $string);
	}
	
	function insertRow($sql) {
			mysqli_query($this->dbLink, $sql) or die('Insert Query Error: '.mysql_error());
	}
	
	
	function updateRow($sql) {
		mysqli_query($this->dbLink, $sql) or die('Update Query Error: '.mysql_error());
		return mysqli_affected_rows($this->dbLink);
	}
	
	
	function deleteRow($sql) {
		mysqli_query($this->dbLink, $sql) or die('Delete Query Error: '.mysql_error());
		return mysqli_affected_rows($this->dbLink);
	}
	
	function noOfRows($sql) {
		$rs = mysqli_query($this->dbLink, $sql) or die('Query Error: '.mysql_error());
		return mysqli_num_rows($rs);
	}
	
	
	function getAutoID() {
		$id = -1;
		$rs = mysqli_query("SELECT LAST_INSERT_ID()");
		if (mysqli_num_rows($rs) == 1) {
			list($id) = mysqli_fetch_array($rs);
		}
		mysqli_free_result($rs);
		return $id;
	}
	
	
	function getRow($query) {
		$row = null;
		$rs = mysqli_query($this->dbLink, $query) or die('Query Error: '.mysql_error());
		if (mysqli_num_rows($rs) != 0) {
			$row = mysqli_fetch_array($rs, MYSQLI_BOTH);
		}
		mysqli_free_result($rs);
		return $row;
	}
		
		
	// Executes the SQL statement passed in and returns the result as an index based array of associative arrays.
	
	function getRows($query) {
		/*$dat = fopen('test.txt', 'a');
		fprintf($dat, "%s\n", $query);
		fclose($dat);*/
		
		$retVal = array();
		$resultSet = mysqli_query($this->dbLink, $query);
		if($resultSet == true) {
			while($row = mysqli_fetch_array($resultSet, MYSQLI_BOTH)) {
				$retVal[] = $row;
			}
			mysqli_free_result($resultSet);
		}
		return $retVal;
	}
	
}
?>

