<div class="main-content">
	<div class="wrapper-frm">
		<h2>Create a New Account</h2>
		<div class="top">
			<?php 
				if(!empty($success_msg)){
					echo '<p class="status-msg success">'.$success_msg.'</p>';
				}elseif(!empty($error_msg)){
					echo '<p class="status-msg error">'.$error_msg.'</p>';
				}
			?>
			<form action="" method="post">
				<div class="frm-input <?php echo !empty(form_error('first_name'))?'error':''; ?>">
					<input type="text" name="first_name" class="user-in" placeholder="First name" value="<?php echo !empty($user['first_name'])?$user['first_name']:''; ?>" required="">
					<?php echo form_error('first_name','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-input <?php echo !empty(form_error('last_name'))?'error':''; ?>">
					<input type="text" name="last_name" class="user-in" placeholder="Last name" value="<?php echo !empty($user['last_name'])?$user['last_name']:''; ?>" required="">
					<?php echo form_error('last_name','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-input">
					<input type="text" name="phone" class="phone-in" placeholder="Phone" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>">
				</div>
				<div class="frm-input">
					<input type="text" name="address" class="addr-in" placeholder="Address" value="<?php echo !empty($user['address'])?$user['address']:''; ?>">
				</div>
				<div class="frm-input <?php echo !empty(form_error('email'))?'error':''; ?>">
					<input type="email" name="email" class="email-in" placeholder="Email" value="<?php echo !empty($user['email'])?$user['email']:''; ?>" required="">
					<?php echo form_error('email','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-input <?php echo !empty(form_error('password'))?'error':''; ?>">
					<input type="password" name="password" class="pass-in" placeholder="Password" required="">
					<?php echo form_error('password','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-input <?php echo !empty(form_error('conf_password'))?'error':''; ?>">
					<input type="password" name="conf_password" class="pass-in" placeholder="Confirm Password" required="">
					<?php echo form_error('conf_password','<p class="inputErr">','</p>'); ?>
				</div>
				<div class="frm-btn">
					<input type="submit" name="regisSubmit" value="Sign Up">
				</div>
			</form>
		</div>
		<div class="bottom">
			<p>Already Have an Account? <a href="<?php echo base_url('index.php/login'); ?>">Login</a></p>
		</div>
	</div>
</div>