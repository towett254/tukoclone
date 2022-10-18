<div class="main-content">
	<div class="wrapper-frm">
		<h2>Recover Account Password</h2>
		<div class="top">
			<?php 
				if(!empty($success_msg)){
					echo '<p class="status-msg success">'.$success_msg.'</p>';
				}elseif(!empty($error_msg)){
					echo '<p class="status-msg error">'.$error_msg.'</p>';
				}
			?>
		
			<?php if(isset($frmDis) && $frmDis == 0){ ?>
				<h4>Didn’t receive the email? <a href="<?php echo base_url('forgotPassword'); ?>">Request reset link</a></h4>
			<?php }else{ ?>
				<h4>Enter the email address you used to sign up and we'll send you a link to reset your password.</h4>
				<form action="" method="post">
					<div class="frm-input">
						<input type="email" name="email" class="email-in" placeholder="Email" required="">
						<?php echo form_error('email','<p class="inputErr">','</p>'); ?>
					</div>
					<div class="frm-btn">
						<input type="submit" name="forgotSubmit" value="Continue">
					</div>
				</form>
			<?php } ?>
		</div>
		<div class="bottom">
			<p>Don't Want to Reset? <a href="<?php echo base_url('index.php/login'); ?>">Sign In</a></p>
		</div>
	</div>
</div>