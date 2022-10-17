<?php
$userPicture = !empty($user['picture'])?base_url('uploads/profile_picture/thumb/'.$user['picture']):base_url('assets/images/no-profile-pic.png');
$userName = $user['first_name'].' '.$user['last_name'];
?>
<div class="main-content">
	<div class="wrapper-frm">
		<div class="head-menu">
			<div class="menu-tle">
				<h2>My Account</h2>
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
				<h3><?php echo $userName; ?></h3>
				<div class="ac-info">
					<p><b>E-MAIL </b>: <?php echo $user['email']; ?></p>
					<p><b>PHONE </b>: <?php echo $user['phone']; ?></p>
					<p><b>ADDRESS </b>: <?php echo $user['address']; ?></p>
				</div>
			</div> 
		</div>
	</div>
</div>