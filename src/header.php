<?php 
	if(!isset($pageurl))
	$pageurl=$_SERVER['REQUEST_URI'];  
?>  
<?php
if(isset($_SESSION['planid']))
{
	if($_SESSION['planid'] == 1)
	{
		$planname = "Starter Plan";
	}
	elseif($_SESSION['planid'] == 2)
	{
		$planname = "Silver Plan";
	}
	elseif($_SESSION['planid'] == 3)
	{
		$planname = "Gold Plan";
	}
	elseif($_SESSION['planid'] == 4)
	{
		$planname = "Platinum Plan";
	}
}
if(!isset($h1tag))
	$h1tag = "";
?>
<!--Google Analytics code-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72992730-1', 'auto');
  ga('send', 'pageview');

</script>
<!--End of Google Analytics code-->
<div class="container" style="background-color: #ffffff;">
<div class="row">
 <div class="medium-12 columns">
  <div class="medium-12 columns"  style="background-color: #ffffff;">
  	
    <div class="medium-3 columns ">
      <h1><span style="display: none;"><?php echo $h1tag; ?></span><a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>images/logok.png" alt="<?php echo $h1tag; ?>"/></a></h1>
    </div>
  	<div class="medium-9 columns nopadding">
		<div class="medium-2 columns nopadding right">
			<a href="https://twitter.com/konsear" target="_blank"><img src="<?php echo BASE_URL; ?>images/twit.gif" alt="social links" class="socialnet"/></a> 
			<a href="https://www.facebook.com/#!/Konsear" target="_blank"> <img src="<?php echo BASE_URL?>images/facebook.gif" alt="social links" class="socialnet"></a>  	
		</div>
		
		<div class="medium-12 columns nopadding hideinmobile" style="display: flex; bottom: 0;">
			<div class="medium-5 columns nopaddingleft">
			  <div class="row collapse hideinmobile" style="position: absolute; bottom: 0;">
			  	<p>&nbsp;</p>
			  	<form name="search" id="search" method="POST" action="<?php echo BASE_URL?>search_results.php">
			        <div class="medium-9 columns nopaddingright">
			        	<input type="text" name="searching" placeholder="eg: 20% off" style="width: 100%; line-height: 25px;">
			        </div>
			        <div class="medium-2 columns nopadding">
			          	<input type="submit" class="button postfix" value="Go">
			        </div>
					<div class="medium-1 columns">
					</div>
				</form> 
		      </div>
			</div>
			<div class="medium-7 columns nopadding hideinmobile">
				<!--publisher-->
				<?php 
				if(isset($_SESSION['pubid']))
				{ ?>
					<ul id="user_spot">
					    <li><a href="#"><span class="username" style="color: #333; font-weight: bold"><?php echo $_SESSION['pname']?> (<?php echo $planname?>)</span></a>
					        <!--<ul id="user_spot_links">
					            <li><a href="<?php echo BASE_URL?>logout.php" class="usermenu" style="color: #333;">Sign Out</a></li>
					        </ul>-->
					    </li>
					</ul>
				<?php } ?>
				<!--subscriber-->
				<?php 
				if(isset($_SESSION['subid']))
				{ ?>
					<ul id="user_spot">
					    <li><a href="#"><span class="username" style="color: #333; font-weight: bold"><?php echo $_SESSION['sname']?></span></a>
					        <!--<ul id="user_spot_links">
					            <li><a href="<?php echo BASE_URL?>logout.php" class="usermenu" style="color: #333;">Sign Out</a></li>
					        </ul>-->
					    </li>
					</ul>
				<?php } 
					if(!isset($_SESSION['subid']) && !isset($_SESSION['pubid']))
					{
						$paddingtop = 'style="margin-top: 15px;"';
						$loginbtn = '<a class="button right addbusinessbtn" href="login.php">Login</a>';
					}
					else
					{
						$paddingtop = '';
						$loginbtn = '<a class="button right addbusinessbtn" href="logout.php">Logout</a>';
					}
				?>
				<?php 
					if($pageurl == "home")
					{
				?>
						<div class="medium-12 columns nopadding" <?php echo $paddingtop; ?>>
				<?php 
					if(!isset($_SESSION['subid']) && !isset($_SESSION['pubid']))
							echo '<a class="button right addbusinessbtn" href="register.php">Add Your Business</a>';
					else
							echo $loginbtn;
				?>
							<a class="button right publishofferbtn" href="publish_offer.php">Publish Your Offer</a>		
						</div>
				<?php
					}
					else
					{
				?>
						<div class="medium-12 columns nopadding" <?php echo $paddingtop; ?>>
							<?php echo $loginbtn; ?>
							<a class="button right publishofferbtn" href="publish_offer.php">Publish Your Offer</a>		
						</div>
				<?php
					}
				?>
				
			</div>
		</div>
	</div>
  </div>
 </div>
 
</div>
</div>