<?php
$userPicture = !empty($user['picture'])?base_url('uploads/profile_picture/thumb/'.$user['picture']):base_url('assets/images/no-profile-pic.png');
$userName = $user['first_name'].' '.$user['last_name'];
?>
<div class="main-content">
	<div class="wrapper-frm">
		<div class="head-menu">
			<div class="menu-tle">
				<h2>Update Account</h2>
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
				<form action="" method="post" enctype="multipart/form-data">
					<div class="frm-input">
						<input type="file" name="picture" class="file-in" placeholder="Choose Image File">
					</div>
					<div class="frm-input <?php echo !empty(form_error('first_name'))?'error':''; ?>">
						<input type="text" name="first_name" class="user-in" placeholder="First name" value="<?php echo !empty($user['first_name'])?$user['first_name']:''; ?>" required="">
						<?php echo form_error('first_name','<p class="inputErr">','</p>'); ?>
					</div>
					<div class="frm-input <?php echo !empty(form_error('last_name'))?'error':''; ?>"">
						<input type="text" name="last_name" class="user-in" placeholder="Last name" value="<?php echo !empty($user['last_name'])?$user['last_name']:''; ?>" required="">
						<?php echo form_error('last_name','<p class="inputErr">','</p>'); ?>
					</div>
					<div class="frm-input <?php echo !empty(form_error('email'))?'error':''; ?>"">
						<input type="email" name="email" class="email-in" placeholder="Email" value="<?php echo !empty($user['email'])?$user['email']:''; ?>" required="">
						<?php echo form_error('email','<p class="inputErr">','</p>'); ?>
					</div>
					<div class="frm-input">
						<input type="text" name="phone" class="phone-in" placeholder="Phone" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>">
					</div>
					<div class="frm-input">
						<input type="text" name="address" class="addr-in" placeholder="Address" value="<?php echo !empty($user['address'])?$user['address']:''; ?>">
					</div>
					<div class="frm-btn">
						<input type="submit" name="updateProfile" value="Update">
					</div>
				</form>
			</div> 
		</div>
	</div>
</div>