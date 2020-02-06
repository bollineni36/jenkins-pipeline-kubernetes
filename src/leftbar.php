<?php

	$db = new VDatabase(true);
		
		$query23 = sprintf("select a.AccountState from %s%s a, %s%s o WHERE OfferActiveFlag = 'Active' AND o.AccountId = a.AccountId AND OfferEndDate >= NOW() group by a.AccountState order by count(*) desc LIMIT 7", DB_PREFIX, ACCOUNT_TABLE, DB_PREFIX, PUBLISHEROFFERS_TABLE);
			$rows23 = $db->getRows($query23); 
		
		$query33 = sprintf("SELECT * FROM %s%s WHERE OfferActiveFlag = 'Active' AND OfferImage <> '' AND OfferEndDate >= NOW() ORDER BY Hits DESC LIMIT 3", DB_PREFIX, PUBLISHEROFFERS_TABLE);
			$rows33 = $db->getRows($query33); 
		
	$db->closeConnection();
?>
		<div class="medium-3 columns">
		 	<div id="menu4" class="vbottomspace">
				<ul>
					<li id="abc">Most Popular Locations</li> 
					<?php
						foreach($rows23 AS $row23)
						{
					?>	
							<li><a href="<?php echo BASE_URL?>state_offer_details.php?st=<?php echo $row23['AccountState']?>"><?php echo $row23['AccountState']?></a></li> 			
					<?php
						}					
					?>
				</ul>
			</div>
			<?php
				foreach($rows33 AS $row33)
				{
			?>
				<div class="vbottomspace">
					<p class="heading">Top Picks</p>
					<p class="toppicks"><a href="<?php echo BASE_URL?>offer_details.php?od=<?php echo $row33['PublisherOfferId']?>"><img src='<?php echo BASE_URL?><?php echo str_replace("thumb","full",$row33["OfferImage"])?>'></a></p>
				</div>		
			<?php
				}					
			?>
			
		</div>