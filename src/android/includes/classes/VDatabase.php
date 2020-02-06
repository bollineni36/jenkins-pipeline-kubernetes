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
		$this->dbLink = mysql_connect($hostName, $userName, $pwd) or die($_SESSION['errMsg'] = "Could not Connect to the DATABASE"); 
		mysql_select_db($dbName, $this->dbLink) or die($_SESSION['errMsg']="Could not select the DATABASE");
	}
	
	
	function closeConnection() {
		if ($this->dbLink != null) {		
			mysql_close($this->dbLink);
		}
	}
	
	
	function begin() {
		if ($this->dbLink != null) {
			mysql_query('BEGIN');
		}
	}
	
	
	function commit() {
		if ($this->dbLink != null) {
			mysql_query('COMMIT');
		}
	}
	
	
	function rollback() {
		if ($this->dbLink != null) {
			mysql_query('ROLLBACK');
		}
	}
	
	
	function insertRow($sql) {
			mysql_query($sql, $this->dbLink) or die('Insert Query Error: '.mysql_error());
	}
	
	
	function updateRow($sql) {
		mysql_query($sql, $this->dbLink) or die('Update Query Error: '.mysql_error());
		return mysql_affected_rows();
	}
	
	
	function deleteRow($sql) {
		mysql_query($sql, $this->dbLink) or die('Delete Query Error: '.mysql_error());
		return mysql_affected_rows();
	}
	
	function noOfRows($sql) {
		$rs = mysql_query($sql, $this->dbLink) or die('Query Error: '.mysql_error());
		return mysql_num_rows($rs);
	}
	
	
	function getAutoID() {
		$id = -1;
		$rs = mysql_query("SELECT LAST_INSERT_ID()");
		if (mysql_num_rows($rs) == 1) {
			list($id) = mysql_fetch_array($rs);
		}
		mysql_free_result($rs);
		return $id;
	}
	
	
	function getRow($query) {
		$row = null;
		$rs = mysql_query($query, $this->dbLink) or die('Query Error: '.mysql_error());
		if (mysql_num_rows($rs) != 0) {
			$row = mysql_fetch_array($rs, MYSQL_BOTH);
		}
		mysql_free_result($rs);
		return $row;
	}
		
		
	// Executes the SQL statement passed in and returns the result as an index based array of associative arrays.
	
	function getRows($query) {
		/*$dat = fopen('test.txt', 'a');
		fprintf($dat, "%s\n", $query);
		fclose($dat);*/
		
		$retVal = array();
		$resultSet = mysql_query($query);
		if($resultSet == true) {
			while($row = mysql_fetch_array($resultSet, MYSQL_BOTH)) {
				$retVal[] = $row;
			}
			mysql_free_result($resultSet);
		}
		return $retVal;
	}
	
}
?>
