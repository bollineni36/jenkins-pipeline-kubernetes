<div class="row collapse vbottomspace">
	<ul class="right vsmallnormal greyfont" id="footer">
	<?php
		if (!($this->session->userdata('uagent')))
		{
	?>
		  <li><a href="<?php echo base_url(); ?>agent/login" class="button smallestnav">LOG IN</a></li> 
	<?php 
		}
		else 
		{
			
	?>
			<li><a href="<?php echo base_url(); ?>agent/dashboard" class="button smallestnav">HELLO <span class="vgreenfont"><?php echo strtoupper($this->session->userdata('fname'))?></span></a></li> |  
			<li><a href="<?php echo base_url(); ?>agent/dashboard" class="button smallestnav">DASHBOARD</a></li> | 
			<li><a href="<?php echo base_url(); ?>agent/logout" class="button smallestnav">LOG OUT</a></li> 
	<?php 
		}
	?>
		  <?php /*|
		  <li><a href="#" class="button smallernav">Privacy Policy</a></li> |
		  <li><a href="#" class="button smallernav">Join the Photography Team</a></li> |
		  <li><a href="#" class="button smallernav">Photographer Dashboard</a></li>
		  */?>
	</ul>
</div>

<div class="row collapse">
  <img src="<?php echo base_url(); ?>assets/images/peek1.png" class="right" style="padding: 0 3px 3px 0;"/>
</div>