<?php

defined('SINAUID') OR exit('No direct script access allowed');
if(!isset($_SESSION['login']) || $_SESSION['login'] == false) {
	header('Location: ' . HTTP . '?page=login');
	die();
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">

	<title><?php print isset($title) ? TITLE . " - " . $title : TITLE . " - Untitled";?></title>

	<link href="<?=HTTP.'app/theme/assets/img/icon.png';?>" rel="shortcut icon">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/Ionicons/css/ionicons.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/jquery-switchbutton/jquery.switchButton.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/select2/css/select2.min.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/SpinKit/spinkit.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/summernote/summernote-bs4.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/noty/noty.css';?>" >
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/noty/themes/bootstrap-v4.css';?>" >
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/css/bracket.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/css/costom.css';?>">

	<script src="<?=HTTP.'app/theme/assets/lib/jquery/jquery.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/jquery-ui/jquery-ui.js';?>"></script>

	<!-- Sweetalert -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.0/sweetalert2.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.0/sweetalert2.js"></script>

	<script type="text/javascript">
		var request = {
			base_url 	: '<?=HTTP;?>',
			ajax_url 	: '<?=HTTP.'?do=';?>'
		};
		function logoutConfirm(link){
			Swal({
				text: 'Are you sure you want to logout?',
				animation: false,
  				customClass: 'animated tada',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Yes, logout now!',
				cancelButtonText: 'Cancel',
			}).then((result) => {
				if (result.value) {
					location.href = link;
				}
			})
		}
	</script>
</head>
<body>

	<!-- Content begin here-->
	<div class="br-logo">
		<!-- <a href="<?=HTTP.'?page=dashboard';?>"><span>[</span> Sinau.<span class="tx-info">ID</span> <span>]</span> </a> -->
		<a href="<?=HTTP.'?page=dashboard';?>"><span style="align:center;"><img src="<?=HTTP.'app/theme/assets/img/logo-main.png';?>" width="140"></span> </a>
	</div>
	<div class="br-sideleft overflow-y-auto">
		<ul class="br-sideleft-menu">
			<li class="br-menu-item">
				<a class="br-menu-link" href="<?=HTTP.'?page=dashboard';?>">
					<i class="menu-item-icon ion ion-md-grid tx-24"></i>
					<span class="menu-item-label">Dashboard</span>
				</a>
			</li>

			<?php if ($_SESSION['is_admin']): ?>
				
				<?php if (isset($_SESSION['role']->module) || isset($_SESSION['role']->module_group) || isset($_SESSION['role']->module_type)): ?>
					<li class="br-menu-item">
						<a href="#" class="br-menu-link with-sub">
							<i class="menu-item-icon icon ion-ios-journal tx-24"></i>
							<span class="menu-item-label">Learning Module</span>
						</a>
						<ul class="br-menu-sub nav flex-column">
							<?php if (isset($_SESSION['role']->module)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=module';?>">Manage</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->module_group)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=module_group';?>">Group</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->module_type)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=module_type';?>">Type</a>
								</li>
							<?php endif;?>
						</ul>
					</li>
				<?php endif;?>
				
				<?php if (isset($_SESSION['role']->question) || isset($_SESSION['role']->question_group) || isset($_SESSION['role']->question_type)): ?>
					<li class="br-menu-item">
						<a href="#" class="br-menu-link with-sub">
							<i class="menu-item-icon icon ion-ios-copy tx-24"></i>
							<span class="menu-item-label">Question</span>
						</a>
						<ul class="br-menu-sub nav flex-column">
							<?php if (isset($_SESSION['role']->question)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=question';?>">Manage</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->question_group)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=question_group';?>">Group</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->question_type)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=question_type';?>">Type</a>
								</li>
							<?php endif;?>
						</ul>
					</li>
				<?php endif;?>

				<?php if (isset($_SESSION['role']->answer)): ?>
					<li class="br-menu-item">
						<a class="br-menu-link" href="<?=HTTP.'?page=answer';?>">
							<i class="menu-item-icon ion ion-ios-key tx-24"></i>
							<span class="menu-item-label">Answer</span>
						</a>
					</li>
				<?php endif;?>
				
				<?php if (isset($_SESSION['role']->admin) || isset($_SESSION['role']->admin_group)): ?>
					<li class="br-menu-item">
						<a href="#" class="br-menu-link with-sub">
							<i class="menu-item-icon icon ion-md-contact tx-24"></i>
							<span class="menu-item-label">Admin</span>
						</a>
						<ul class="br-menu-sub nav flex-column">
							<?php if (isset($_SESSION['role']->admin)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=admin';?>">Manage</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->admin_group)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=admin_group';?>">Group</a>
								</li>
							<?php endif;?>
						</ul>
					</li>
				<?php endif;?>
				
				<?php if (isset($_SESSION['role']->participant) || isset($_SESSION['role']->participant_group)): ?>
					<li class="br-menu-item">
						<a href="#" class="br-menu-link with-sub">
							<i class="menu-item-icon icon ion-md-contacts tx-24"></i>
							<span class="menu-item-label">Participant</span>
						</a>
						<ul class="br-menu-sub nav flex-column">
							<?php if (isset($_SESSION['role']->participant)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=admin';?>">Manage</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->participant_group)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=participant_group';?>">Group</a>
								</li>
							<?php endif;?>
						</ul>
					</li>
				<?php endif;?>

				<?php if (isset($_SESSION['role']->config)): ?>
					<li class="br-menu-item">
						<a class="br-menu-link" href="<?=HTTP.'?page=config';?>">
							<i class="menu-item-icon ion ion-ios-settings tx-24"></i>
							<span class="menu-item-label">Configuration</span>
						</a>
					</li>
				<?php endif;?>
			
				<?php if (isset($_SESSION['role']->change_logs)): ?>
					<li class="br-menu-item">
						<a class="br-menu-link" href="<?=HTTP.'?page=change_logs';?>">
							<i class="menu-item-icon ion ion-ios-stats tx-24"></i>
							<span class="menu-item-label">Change Log</span>
						</a>
					</li>
				<?php endif;?>
			<?php endif;?>

			<?php if (!$_SESSION['is_admin']): ?>
				
				<?php if (isset($_SESSION['role']->module)): ?>
					<li class="br-menu-item">
						<a class="br-menu-link" href="<?=HTTP.'?page=module';?>">
							<i class="menu-item-icon icon ion-ios-journal tx-24"></i>
							<span class="menu-item-label">Learning Module</span>
						</a>
					</li>
				<?php endif;?>
				
				<?php if (isset($_SESSION['role']->assessment)): ?>
					<li class="br-menu-item">
						<a href="#" class="br-menu-link with-sub">
							<i class="menu-item-icon icon ion-ios-copy tx-24"></i>
							<span class="menu-item-label">Online Exam</span>
						</a>
						<ul class="br-menu-sub nav flex-column">
							<?php if (isset($_SESSION['role']->assessment->index)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=assessment';?>">List Assessments</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->assessment->record)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=assessment_activity';?>">Assessment Activity</a>
								</li>
							<?php endif;?>
							<?php if (isset($_SESSION['role']->assessment->record)): ?>
								<li class="sub-item">
									<a class="sub-link" href="<?=HTTP.'?page=assessment_record';?>">Assessment Status</a>
								</li>
							<?php endif;?>
						</ul>
					</li>
				<?php endif;?>
			
				<?php if (isset($_SESSION['role']->change_logs)): ?>
					<li class="br-menu-item">
						<a class="br-menu-link" href="<?=HTTP.'?page=change_logs';?>">
							<i class="menu-item-icon ion ion-ios-stats tx-24"></i>
							<span class="menu-item-label">Change Log</span>
						</a>
					</li>
				<?php endif;?>
			<?php endif;?>

			<?php if (isset($_SESSION['role']->account_profile)): ?>
				<label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-success">Account Profile</label>
				
				<?php if (isset($_SESSION['role']->account_profile->detail)): ?>
					<li class="br-menu-item">
						<a class="br-menu-link" href="<?=HTTP.'?page=personal_info';?>">
							<i class="menu-item-icon icon ion ion-md-information-circle-outline tx-24"></i>
							<span class="menu-item-label">Personal Info</span>
						</a>
					</li>
				<?php endif;?>
				
				<?php if (isset($_SESSION['role']->account_profile->change_password)): ?>
					<li class="br-menu-item">
						<a class="br-menu-link" href="<?=HTTP.'?page=change_password';?>">
							<i class="menu-item-icon icon ion ion-md-unlock tx-24"></i>
							<span class="menu-item-label">Change Password</span>
						</a>
					</li>
				<?php endif;?>
			<?php endif;?>
		</ul>
	</div>
	<div class="br-header">
		<div class="navicon-left hidden-md-down">
			<a id="btnLeftMenu" href="#">
				<i class="icon ion-md-menu"></i>
			</a>
		</div>
		<div class="navicon-left hidden-lg-up">
			<a id="btnLeftMenuMobile" href="#">
				<i class="icon ion-md-menu"></i>
			</a>
		</div>
		<div class="br-header-right">
			<nav class="nav">
				<?php if ($_SESSION['is_admin']): ?>
					<a class="btn btn-outline-primary btn-oblong" href="#"><i class="icon ion ion-md-flash tx-18"></i> <?=$_SESSION['group'];?> </a>
				<?php else: ?>
					<?php if($_SESSION['group_id'] == DEFAULT_GROUP_ID): ?>
						<a class="btn btn-outline-warning btn-oblong" href="<?=HTTP.'?page=upgrade';?>"><i class="icon ion ion-md-flash tx-18"></i> Upgrade </a>
					<?php else: ?>
						<a class="btn btn-outline-primary btn-oblong" href="#"><i class="icon ion ion-md-star tx-18"></i> <?=$_SESSION['group'];?> </a>
					<?php endif;?>
				<?php endif;?>
				&nbsp
				<a class="btn btn-outline-danger btn-oblong" href="javascript:;" onclick="return logoutConfirm('<?=HTTP.'?page=logout';?>');" ><i class="icon ion ion-md-power tx-18"></i> Logout</a>
			</nav>
		</div>
	</div>