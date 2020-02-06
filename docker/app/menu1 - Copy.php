<?php $pageurl=$_SERVER['REQUEST_URI'];  ?>  
<div class="row">
		<div class="medium-9 columns nopaddingright">
			<nav class="top-bar" data-topbar  style="margin-bottom:20px;">
			  <ul class="title-area">
			    <li class="name">
			    </li>
			     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			  </ul>
			  <section class="top-bar-section">
			    <!-- Right Nav Section -->
			    <ul>
			      <li class="<?php if($pageurl == '/konsears/') echo 'active'; ?>"><a href="<?php echo BASE_URL?>">Home</a></li>
			      	<li class="has-dropdown">
				        <a href="#">Locations</a>
				        <ul class="dropdown">
				          <li class="has-dropdown">
						  	<a href="usa_offers.php">USA</a>
								<ul class="dropdown" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
									<?php
										$db = new VDatabase(true);
										
										$query55 = sprintf("SELECT * FROM %s%s", DB_PREFIX, STATES_TABLE);
										$rows55 = $db->getRows($query55);
										
										$db->closeConnection();
										
										foreach($rows55 as $row55)
										{
											$statename = $row55['StateName'];
											echo '<li><a href="state_offer_details.php?st='.$statename.'">'.$statename.'</a></li>';
										}
									?>
								</ul>
						  </li>
						 <!-- <li><a href="#">All</a></li>-->
				        </ul>
					</li>
				  <li><a href="lookup_offers.php">Lookup Offers</a></li>
				  <li class="has-dropdown <?php if(($pageurl == '/konsears/plans_pricing.php') || ($pageurl == '/konsears/createoffer.php')) echo 'active'; ?>">
			        <a href="#">Publish Offers</a>
					<ul class="dropdown">
					 <?php if(!isset($_SESSION['pubid'])) { ?>
			          <li><a href="<?php echo BASE_URL?>register.php">Register</a></li>
					  <li><a href="<?php echo BASE_URL?>login.php">Login</a></li>
					 <?php } ?> 
					 <?php if(isset($_SESSION['pubid'])) { ?>
					  <li><a href="<?php echo BASE_URL?>manage_offers.php">Manage Offers</a></li>
					  <li><a href="<?php echo BASE_URL?>createoffer.php">Create Offer</a></li>
					 <?php } ?> 
			          <li><a href="<?php echo BASE_URL?>how_it_works.php">How it works?</a></li>
					  <li><a href="<?php echo BASE_URL?>plans_pricing.php">Plans and Pricing</a></li>
					</ul>
			      </li>
				  <?php if(isset($_SESSION['pubid'])) { ?>
				  	<li class="<?php if($pageurl == '/konsears/account.php') echo 'active'; ?> has-dropdown">
						<a href="#">My Account</a>
						<ul class="dropdown">
				          <li><a href="<?php echo BASE_URL?>dashboard.php">Dashboard</a></li>
				          <li><a href="<?php echo BASE_URL?>edit_profile.php">Edit Profile</a></li>
				          <li><a href="<?php echo BASE_URL?>change_password.php">Change Password</a></li>
						  <li><a href="<?php echo BASE_URL?>accounts.php">Manage Accounts</a></li>
						</ul>
					</li>	
				  <?php } elseif(isset($_SESSION['subid'])) {?>
				  	<li class="has-dropdown">
						<a href="#">My Account</a>
						<ul class="dropdown">
				          <li><a href="<?php echo BASE_URL?>sub_change_password.php">Change Password</a></li>
				          <li><a href="<?php echo BASE_URL?>sub_profile.php">Profile</a></li>
						</ul>
					</li>	
				  <?php } else {?>
				  	<li class="<?php if(($pageurl == '/konsears/login.php') || ($pageurl == '/konsears/sublogin.php')) echo 'active'; ?> has-dropdown">
						<a href="#">Login</a>
						<ul class="dropdown">
				          <li><a href="<?php echo BASE_URL?>login.php">Publisher Login</a></li>
				          <li><a href="<?php echo BASE_URL?>sublogin.php">Subscriber Login</a></li>
						</ul>
					</li>
				  <?php } ?>
			 	</ul>
				
			  </section>
			</nav>
		</div>
		<div class="medium-3 columns nopaddingleft">
			  <div class="row collapse" style="background: #333333;">
			  	<form name="search" id="search" method="POST" action="search_results.php">
			        <div class="medium-9 columns nopaddingright">
			        	<input type="text" name="searching" placeholder="search" style="padding: 0.3rem 0 0.3rem 0.3rem; width: 100%; margin: 8px 0;">
			        </div>
			        <div class="medium-2 columns nopadding">
			          	<input type="submit" class="button postfix" style="margin: 8px 0; height: 29px; line-height: 30px;" value="Go">
			        </div>
					<div class="medium-1 columns">
					</div>
				</form> 
		      </div>
		</div>
		   
	</div>
	<style>
		#hidescroll::-webkit-scrollbar {
			display: none; 
		}
	</style>