


<div class="main-content">
	<div class="wrapper-frm">
		<h2>Login To Your Account</h2>
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
					<input type="email" name="email" class="email-in" placeholder="Email" required="">
					<?php echo form_error('email','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-input">
					<input type="password" name="password" class="pass-in" placeholder="Password" required="">
					<?php echo form_error('password','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-info">
					<div class="check">
						<input type="checkbox" id="remb" name="rememberMe" value="1">
						<label for="remb"><span></span>Remember me</label>
					</div>
					<a href="<?php echo base_url('forgotPassword'); ?>">Forgot Password?</a>
					<div class="clear"></div>
				</div>
				<div class="frm-btn">
					<input type="submit" name="loginSubmit" value="Sign In">
				</div>
			</form>
		</div>
		<div class="bottom">
			<p>Don't Have an Account? <a href="<?php echo base_url('index.php/registration'); ?>">Register Now</a></p>
		</div>
	</div>
</div>