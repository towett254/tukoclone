<div class="main-content">
	<div class="wrapper-frm">
		<h2>Reset Account Password</h2>
		<div class="top">
			<?php 
				if(!empty($success_msg)){
					echo '<p class="status-msg success">'.$success_msg.'</p>';
				}elseif(!empty($error_msg)){
					echo '<p class="status-msg error">'.$error_msg.'</p>';
				}
			?>
			<form action="" method="post">
				<div class="frm-input">
					<input type="password" name="password" class="pass-in" placeholder="Password" required="">
					<?php echo form_error('password','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-input">
					<input type="password" name="conf_password" class="pass-in" placeholder="Confirm password" required="">
					<?php echo form_error('conf_password','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-btn">
					<input type="submit" name="resetSubmit" value="Update Pasword">
				</div>
			</form>
		</div>
		<div class="bottom">
			<p>Don't Want to Reset? <a href="<?php echo base_url('index.php/login'); ?>">Sign In</a></p>
		</div>
	</div>
</div>