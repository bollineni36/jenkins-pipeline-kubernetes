<?php 
	require_once("includes/start.php");
	require_once("includes/config.php");
	require_once("includes/tablenames.php");
	require_once("includes/constants.php");
	require_once("includes/classes/VDatabase.php");
	require_once("includes/vutils.php");
	require_once("includes/vlib.php");
	require_once("includes/validations.php");
	
		$db = new VDatabase(true);
		$subid = $_GET['subid'];
	 $query = sprintf("SELECT * FROM kon_subscribers WHERE SubscriberId = '%s'",$subid);
						
		$row = $db->getRow($query);				
		$cond = "";
		if($row['InterestHeaders'] == "")
		{
			$cond = 1;
		}
		else
		{
			$interestheaders = explode(',',$row['InterestHeaders']);
		
			$i=0;
			foreach($interestheaders as $ih)
			{ 
				if($ih !== "")
				{
					if($i==0)
					{
						$cond = "InterestHeaderId ='".$ih."'"; 
					}
					else
					{
						$cond .= " OR InterestHeaderId ='".$ih."'"; 
					}
					$i++;
				}
			}
		}
		
		$query = sprintf("SELECT *,(SELECT InterestHeaderName FROM kon_interestheader WHERE kon_interestheader.InterestHeaderId = kon_interestdetails.InterestHeaderId) AS InterestHeaderName FROM kon_interestdetails WHERE %s",$cond);
						
		$rows = $db->getRows($query);	
		$y=0;
		$res = array();
		//To store Interest Header Name temporarily
		$temp = "";
		//To check the temp is first time or not
		$temp1 = 0;
			foreach($rows as $row)
			{
				$y++;
				if($temp == "")
				{
					$temp = $row['InterestHeaderName'];
					$temp1 = 1;
				}
				else
				{
					$temp1 = 0;
				}
				
				if($temp == $row['InterestHeaderName'])
				{
					if($temp1 == 1)
					{
						$res[] = array("InterestDetailId"=>$row['InterestDetailId'],"InterestDetailName"=>$row['InterestDetailName'],"InterestHeaderName"=>$row['InterestHeaderName']);	
					}
					else
					{
						$res[] = array("InterestDetailId"=>$row['InterestDetailId'],"InterestDetailName"=>$row['InterestDetailName'],"InterestHeaderName"=>"");	
					}
				}
				else
				{
					$res[] = array("InterestDetailId"=>$row['InterestDetailId'],"InterestDetailName"=>$row['InterestDetailName'],"InterestHeaderName"=>$row['InterestHeaderName']);
					
					$temp = $row['InterestHeaderName'];
				}
			}
			if($y==0)
				echo "failed";
				else
		
			echo json_encode($res);
?>