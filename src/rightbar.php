<?php

	$db = new VDatabase(true);
		
		$query33 = sprintf("SELECT * FROM %s%s WHERE OfferActiveFlag = 'Active' AND OfferEndDate >= NOW() ORDER BY Hits DESC LIMIT 6", DB_PREFIX, PUBLISHEROFFERS_TABLE);
			$rows33 = $db->getRows($query33); 
		
	$db->closeConnection();
?>
<div class="medium-3 columns">
			<div  id="sidelinks" class="vbottomspace">
				<ul>
					<li id="abc">Most Popular Offers</li> 
					<?php
					foreach($rows33 as $row33)
						{
							$oid = $row33['PublisherOfferId'];
							$offername = $row33['OfferName'];
					?>
					<li><a href="<?php echo BASE_URL?>offer_details.php?od=<?php echo $oid?>"><p class="nobottom"><?php echo $offername?></p></a></li> 
					<?php } ?>
				</ul>		
			</div>
			<div class=" vbottomspace">
				<div class="row collapse sidezipcode">
					<p style="margin:10px;" class="textcenter">Enter zipcode to search nearest offers to you</p>
					<div class="medium-1 columns">&nbsp;</div>
					<div class="medium-10 columns">
						<form name="searchbyzip" id="searchbyzip" method="POST" action="<?php echo BASE_URL?>zip_offers.php">
						<p class="textcenter nobottom">
							<input type="text" name="search" id="search" value="">
							<input type="submit" name="submit" id="submit" value="Go" class="tiny button radius">
						</p>
						</form>
					</div>
					<div class="medium-1 columns">&nbsp;</div>
				</div>
			</div>
			
			<div class="row collapse vbottomspace">
				<img src="<?php echo BASE_URL?>images/android.png">
			</div>
			<div class="row collapse">
				<img src="<?php echo BASE_URL?>images/iphone.png">
			</div>
		</div>