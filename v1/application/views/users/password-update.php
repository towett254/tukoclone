<?php
$userPicture = !empty($user['picture'])?base_url('uploads/profile_picture/thumb/'.$user['picture']):base_url('assets/images/no-profile-pic.png');
$userName = $user['first_name'].' '.$user['last_name'];
?>
<div class="main-content">
	<div class="wrapper-frm">
		<div class="head-menu">
			<div class="menu-tle">
				<h2>Update Password</h2>
			</div>
			<div class="top-nav">
				<?php $this->load->view('elements/nav_menu.php'); ?>
			</div>
		</div>
		<div class="ucontent">
			<div class="right-pnl">
				<img src="<?php echo $userPicture; ?>" alt="<?php echo $userName; ?>">
				<h2><?php echo $userName; ?></h2>
			</div>
			<div class="left-pnl">
				<?php 
					if(!empty($success_msg)){
						echo '<p class="status-msg success">'.$success_msg.'</p>';
					}elseif(!empty($error_msg)){
						echo '<p class="status-msg error">'.$error_msg.'</p>';
					}
				?>
				<form action="" method="post">
					<div class="frm-input <?php echo !empty(form_error('old_password'))?'error':''; ?>">
						<input type="password" name="old_password" class="pass-in" placeholder="Current Password" required="">
						<?php echo form_error('old_password','<p class="inputErr">','</p>'); ?>
					</div>
					<div class="frm-input <?php echo !empty(form_error('password'))?'error':''; ?>">
						<input type="password" name="password" class="pass-in" placeholder="New Password" required="">
						<?php echo form_error('password','<p class="inputErr">','</p>'); ?>
					</div>
					<div class="frm-input <?php echo !empty(form_error('conf_password'))?'error':''; ?>">
						<input type="password" name="conf_password" class="pass-in" placeholder="Confirm Password" required="">
						<?php echo form_error('conf_password','<p class="inputErr">','</p>'); ?>
					</div>
					<div class="frm-btn">
						<input type="submit" name="updatePassword" value="Update">
					</div>
				</form>
			</div> 
		</div>
	</div>
</div>