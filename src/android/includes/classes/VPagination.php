<?php
//figure out qstring problem... gen_qstring()

class VPagination{

	var $results; //query results, appended with LIMIT
	var $total_rows; //total number of results
	var $rows_to_show; //rows to show each page
	var $total_pages; //total pages...
	var $current_page; //current page your on
	var $next_page; //the next page, duh.
	var $prev_page; //the previous page, double duh..
	var $index; //the current row you are beginning at for each page
	var $qstring; //used to preserve anything that was previously in the address bar example test=1&test2=2
	
/*	
	var $o_var; //example: ORDER BY id
	var $o; //1 or 0 asc or desc
*/

	//$p = new Paginate("SELECT * FROM users", 10, "test1=1&test2=2");
	function VPagination($query = "", $rows_to_show = "", $qstring = "") {
		$this->total_rows = mysql_num_rows(mysql_query($query));
		$this->rows_to_show = $rows_to_show;
		$this->index = (isset($_GET['nxtsno'])) ? ((int)$_GET['nxtsno']) : 0;
		$this->qstring = $qstring;
		
	/*
		$this->o = (isset($_GET['o'])) ? ((int)$_GET['o']) : null;
		$this->o_var = (isset($_GET['o_var'])) ? ($_GET['o_var']) : null;
		
		if(isset($this->o_var)){
			$query .= " ORDER BY " . $this->o_var;
			
			if(isset($this->o) && ($this->o == 1)) {
				$query .= " ASC";
			} else if (isset($this->o) && ($this->o == 0)) {
				$query .= " DESC";
			}
		}
	*/


		//get the total pages
		if($this->total_rows > $this->rows_to_show) {
			$this->total_pages = ceil($this->total_rows/$this->rows_to_show);
		} else {
			$this->total_pages = 1;
		}
		
		//get what page we are on
		$this->current_page = ($this->index / $this->rows_to_show) + 1;
		
		//um, the next and the previous page #'s. Not really used yet.
		$this->next_page = $this->current_page + 1;
		$this->prev_page = $this->current_page - 1;
		
		$query .= " LIMIT ". $this->index . ", " . $this->rows_to_show;
		$this->results = mysql_query($query);
	}

	//creates Previous 1 2 3 4 Next
	function get_navigation() {
		$this->gen_prev_link();
		
		if($this->get_current_page() < MAX_PAGINATION_NOS) {
			$i = 1;
		} else {
			$i = $this->get_current_page() - MAX_PAGINATION_NOS + 1;
		}
		
		for($k = 1; $i<=$this->get_total_pages() && $k <= MAX_PAGINATION_NOS; $i++, ++$k){
			if($i != $this->get_current_page()) {
				echo $this->gen_href($this->get_index_by_page($i), $i) . " ";
			}else {
				echo $i . " ";
			}
		}
		
		if($i <= $this->get_total_pages()) {
			echo '...';
		}
	
		$this->gen_next_link();
	}

	function gen_prev_link() {
		if($this->get_current_page() > MAX_PAGINATION_NOS) {
			echo $this->gen_href(0, "First") . " "; 
		}
		
		if($this->get_current_page() != 1) {
			echo $this->gen_href($this->get_index() - $this->get_rows_to_show(), "Previous") . " "; 
		}
	}

	function gen_next_link() {
		if($this->get_current_page() != $this->get_total_pages()) {
				echo " " . $this->gen_href($this->get_index() + $this->get_rows_to_show(), "Next"); 
		}
		
		if($this->get_current_page() < $this->get_total_pages() && $this->get_total_pages() > MAX_PAGINATION_NOS) {
			echo " " . $this->gen_href($this->get_index_by_page($this->get_total_pages()), "Last"); 
		}
	}

	//creates a link for you, pass in the index # as well as what you want the link to say
	function gen_href($s = "", $link = "") {
			
		$qm_pos = strpos($this->qstring, "?");
		$amp_pos = strpos($this->qstring, "&");
		$match_str = substr($this->qstring, $qm_pos, $amp_pos - $qm_pos+1);
		
		if(strstr($match_str, "nxtsno")) {
		
			$this->qstring = str_replace($match_str, "", $this->qstring);
		}
		
		$string = "<a href=' " .$_SERVER['PHP_SELF'] . "?nxtsno=" . $s . "&" . $this->get_qstring() . "'>$link</a>";
				
		return $string;
	}

	function get_total_pages() {
		return $this->total_pages;
	}

	function get_total_rows() {
		return $this->total_rows;
	}

	function get_current_page() {
		return $this->current_page;
	}

	function get_rows_to_show() {
		return $this->rows_to_show;
	}

	function get_index() {
		return $this->index;
	}

	function get_index_by_page($page = "") {
		if(!empty($page)) {
			return $this->get_rows_to_show() * ($page - 1);
		} else {
			return 0;
		}
	}

	function get_next_page() {
		return $this->next_page;
	}

	function get_prev_page() {
		return $this->prev_page;
	}

	function getRow() {
		return mysql_fetch_array($this->results);
	}

	function getRows() {
		$retVal = array();
		
		while($row = mysql_fetch_array($this->results, MYSQL_BOTH)) {
				$retVal[] = $row;
		}
		
		return $retVal;
	}
	
	function closeResultSet() {
		mysql_free_result($this->results);		
	}
	
	//staticly call Paginate::gen_qstring();
	function gen_qstring() {
		global $s;
		
	/*
		global $o_var;
		global $o;
	*/
		
		$string .= "nxtsno=" . $s;
		
	/*
		$string .= "&o_var=" . $o_var;
		$string .= "&o=" . $o;
	*/
		
		return $string;
	}

	function get_qstring() {
		if(!empty($this->qstring)) {
			return $this->qstring;
		}
	}

}
?>