<div class="row">
 <div class="medium-12 columns">
  <div class="medium-12 columns"  style="background-color: #ffffff;">
  	
    <div class="medium-3 columns ">
      <h1><a href="<?php echo BASE_URL?>admin/manage_offers.php"><img src="../images/logok.png" /></a></h1>
    </div>
  	<div class="medium-9 columns nopadding">
		
		<a href="https://twitter.com/konsear" target="_blank"><img src="../images/twit.gif" alt="social links" class="socialnet"/></a> 
		<a href="https://www.facebook.com/#!/Konsear" target="_blank"> <img src="../images/facebook.gif" alt="social links" class="socialnet"></a>  	
		<?php 
		if(isset($_SESSION['oid']))
		{ ?>
			<ul id="user_spot" style="padding-top: 60px;">
			    <li><a href="#"><span class="username" style="color: #333; font-weight: bold"><?php echo $_SESSION['oname']?></span></a>
			        <ul id="user_spot_links">
			            <li><a href="logout.php" class="usermenu" style="color: #333;">Sign Out</a></li>
			        </ul>
			    </li>
			</ul>
		<?php } 
		else
		{
			?>
			<ul id="user_spot" style="padding-top: 60px;">
			    <li><a href="login.php"><span class="username" style="color: #333; font-weight: bold">Login</span></a>
			    </li>
			</ul>
			<?php
		}
		?>
		
	</div>
  </div>
 </div>
</div>