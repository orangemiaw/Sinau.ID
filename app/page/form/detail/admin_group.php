<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['detail']}->detail)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return; 
}

$title = "Detail Admin Group";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_admin_group.php';
include 'system/admin_rules.php';

$arr_available_role = $config;
$m_admin_group      = new model_admin_group($db);
$arr_admin_group    = $m_admin_group->get_row(array("admin_group_id" => $_GET['id']/1909));
$arr_role           = json_decode($arr_admin_group['admin_group_role']);

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

<div class="row">
	<div class="col-md-12 col-sm-12">

    <form id="form-detail" class="card shadow-base bd-0">

		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Group Name: <span class="tx-danger">*</span></label>
						<input type="text" name="txtGroupName" value="<?=$arr_admin_group['admin_group_name'];?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
						<select class="form-control select-two" disabled="disabled" name="cbStatus" data-placeholder=" -- Pilih Status -- ">
							<option></option>
							<option value="<?=STATUS_ENABLE;?>" <?php echo set_select(STATUS_ENABLE, $arr_admin_group['admin_group_status']); ?>>Enable</option>
							<option value="<?=STATUS_DISABLE;?>" <?php echo set_select(STATUS_DISABLE, $arr_admin_group['admin_group_status']); ?>>Disable</option>
						</select>
						<ul class="fields-message"></ul>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group mg-t-20">
						<div class="row">

							<?php foreach ($arr_available_role as $controller => $value): ?>

							<div class="col-md-4">
								<h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-20"></h6>
								<label class="ckbox ckbox-danger">
									<input type="checkbox" disabled="disabled" class="mark-all-ingroup"><span class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-20"><?=$value['name'];?></span>
								</label>

								<ul class="role-group-list list-group list-group-striped">
									<?php foreach ($value['methods'] as $method): ?>
									<li class="list-group-item rounded-top-0">
										<label class="ckbox mg-b-0">
											<input type="checkbox" disabled="disabled" name="cbxGroupRoles[<?=$controller;?>][<?php print $method['key'];?>]"  value="1" <?php echo set_checkbox($arr_role->{$controller}->{$method['key']}); ?> readonly>
											<span><strong class="tx-inverse tx-medium"><?=$method['name'];?></strong></span>
										</label>
									</li>
									<?php endforeach;?>
								</ul>
							</div>

							<?php endforeach;?>

						</div>
					</div>
				</div>
			</div>
		</div>

		</form>

	</div>
</div>

<footer class="br-footer">
    <div class="footer-left">
    </div>
    <div class="footer-right d-flex align-items-center">
    </div>
</footer>
</div>
</div>
<?php include ROOT."app/theme/footer.php";?>